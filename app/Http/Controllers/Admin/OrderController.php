<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Customer;
use App\Http\Controllers\DocController;
use App\Http\Controllers\GraphController;
use App\Order;
use App\Product;
use App\Setting;
use App\Status;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Psy\Util\Json;

class OrderController extends Controller
{
    /*
     * Construct function
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.order.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $orders = Order::with('customer', 'status')
            ->where('status_id', '>', 1)
            ->where('status_id', '<', 8)
            ->get();
        return datatables()->of($orders)
            ->addColumn('customer', function ($orders) {
                return $orders->customer->name;
            })
            ->addColumn('status', function ($orders) {
                return $this->get_status_label($orders);
            })
            ->addColumn('total_price', function ($orders) {
                if ((int) $orders->total_price == $orders->total_price) {
                    $price = number_format($orders->total_price);
                } else {
                    $price = number_format($orders->total_price, 2);
                }
                return '<span class="bg-danger text-white px-1 rounded">' . $price . '</span>';
            })
            ->addColumn('action', function ($orders) {
                return $this->get_action_on_table($orders);
            })
            ->escapeColumns([])->toJson();
    }

    /**
     * Fill order information
     *
     * @param Request $request
     * @return View | RedirectResponse
     * @throws Exception
     */
    public function create(Request $request)
    {
        $customers = Customer::get();
        if (!$customers->count()) {
            alert()->info(__('Customer not found'), __('Please create customer data before make an order'));
            return redirect()->route('admin.customer.create');
        }

        $products = Product::get();

        if (!$products->count()) {
            alert()->info(__('Product not found'), __('Please create product data before make an order'));
            return redirect()->route('admin.product.index');
        }

        $categories = Category::get();

        return view('admin.order.create', [
            'categories' => $categories,
            'selected_category' => $request->input('category')
        ]);
    }

    /**
     * Response to create page with product api
     *
     * @param Request $request
     * @throws Exception
     */
    public function create_api(Request $request)
    {
        $product = Product::with(['brand', 'unit'])->where('category_id', $request->input('category'))->get();
        return datatables()->of($product)
            ->addColumn('image', function ($product) {
                $image = asset('imgs/placeholder.jpg');
                if ($product->image) {
                    $image = asset($product->image);
                }
                return '<img style="width: 100px;height: 100px;object-fit: cover;" src="' . $image . '">';
            })
            ->addColumn('name', function ($product) {
                $name = $product->name_en;
                if (app()->getLocale() == "th") {
                    $name = $product->name_th ? $product->name_th : $product->name_en;
                }

                if ($product->vat) {
                    return $name . '&nbsp;&nbsp;<i  style="font-size: 0.6rem;" class="fa fa-percent bg-secondary text-white p-1 rounded-lg"></i>';
                }

                return '<h6 class="mb-0"><strong>' . $name . '</strong></h6>
                            <p class="text-success mb-0">' . $product->brand->name . '</p>';
            })
            ->addColumn('desc', function ($product) {
                if (!$product->desc) {
                    return '<div class="w-100 text-center">None</div>';
                }
                return '<div class="w-100 text-center">' . $product->desc . '</div>';
            })
            ->addColumn('price', function ($product) {
                $price = 0;
                if ( (int) $product->calculate->total_amount == $product->calculate->total_amount ) {
                    $price = number_format($product->calculate->total_amount);
                } else {
                    $price = number_format($product->calculate->total_amount, 2);
                }
                return '<div class="w-100 text-center">
                                <span class="bg-danger text-white px-1 rounded">' . $price . '</span>
                            </div>';
            })
            ->addColumn('value', function ($product) {
                $quantity = 0;
                if (isset(\Session::get('order')[$product->category_id]['products'][$product->id])) {
                    $quantity = \Session::get('order')[$product->category_id]['products'][$product->id]['quantity'];
                }
                return $quantity;
            })
            ->addColumn('quantity', function ($product) {
                $quantity = 0;
                if (isset(\Session::get('order')[$product->category_id]['products'][$product->id])) {
                    $quantity = \Session::get('order')[$product->category_id]['products'][$product->id]['quantity'];
                }

                return '<div class="input-group mb-3">
                              <input type="number" min="0" step="1" class="form-control" onchange="updateCart(this, \'' . route('admin.order.update', $product->id) . '\')" value="' . $quantity . '">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">' . $product->unit->name . '</span>
                            </div>
                        </div>';
            })
            ->escapeColumns([])->toJson();
    }

    /**
     * update order
     *
     * @param Request $request
     * @param int id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::with('category', 'unit')->find($id);

        // If have product in system
        if ($product) {

            if ($this->is_in_order($product)) {
                if ($request->quantity > 0) {
                    // update quantity
                    $this->update_product_quantity($product, $request->quantity);
                    $this->update_price();
                    return $this->responseSuccess(__('Update quantity of :product', ['product' => $product->name]));
                } else {
                    // Delete item from order
                    $this->del_product_from_order($product);
                    $this->update_price();
                    return $this->responseSuccess(__('Remove :product from order', ['product' => $product->name]));
                }

            } else {
                // Add new item to order
                $this->add_product_to_order($product, $request->quantity);
                $this->update_price();
                return $this->responseSuccess(__('Add :product to order', ['product' => $product->name]));
            }

        }

        // If product not exist in system
        return response()->json([
            "status" => "error",
            'data' => null
        ]);
    }

    /**
     * Check is product already in order
     *
     * @param object $product
     * @return boolean
     */
    protected function is_in_order($product)
    {
        $order = \Session::get('order');
        if (isset($order[$product->category_id]['products'][$product->id])) {
            return true;
        }
        return false;
    }

    /**
     * Add new item to order
     *
     * @param object $product
     * @param int $quantity
     */
    protected function add_product_to_order($product, $quantity)
    {
        $order = \Session::get('order');

        $order[$product->category->id]['name'] = $product->category->name;
        $order[$product->category->id]['products'][$product->id] = [
            'name_en' => $product->name_en,
            'name_th' => $product->name_th,
            'unit' => $product->unit->name,
            'image' => $product->image,
            'vat' => $product->vat,
            'price' => $product->calculate->total_amount,
            'price_no_vat' => $product->price,
            'quantity' => $quantity
        ];

        \Session::put('order', $order);
    }

    /**
     * Update Product quantity
     *
     * @param object $product
     * @param int $quantity
     */
    protected function update_product_quantity($product, $quantity)
    {
        $order = \Session::get('order');
        $order[$product->category_id]['products'][$product->id]['quantity'] = $quantity;

        \Session::put('order', $order);
    }


    /**
     * Delete item from cart
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete_item($id)
    {
        $product = Product::with('category', 'unit')->find($id);
        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->back();
        }

        $this->del_product_from_order($product);
        $this->update_price();
        alert()->success(__('Success'), __('Remove :product from order', ['product' => $product->name]));
        return redirect()->back();
    }


    /**
     * Delete product from order
     *
     * @param object $product
     */
    protected function del_product_from_order($product)
    {
        $order = \Session::get('order');
        unset($order[$product->category->id]['products'][$product->id]);

        \Session::put('order', $order);
    }

    /**
     * Update price
     */
    protected function update_price()
    {
        $order = \Session::get('order');

        $total = 0;
        foreach ($order as $key => $each_category) {
            $price = 0;
            foreach ($each_category['products'] as $product) {
                $price += $product['quantity'] * $product['price'];
            }
            $order[$key]['total'] = $price;
            $total += $price;
        }

        \Session::put('total', $total);
        \Session::put('order', $order);
    }

    /**
     * Clear item in order
     *
     * @return RedirectResponse
     */
    public function clear()
    {
        \Session::forget('total');
        \Session::forget('order');

        return redirect()->route('admin.order.index');
    }

    /**
     * Recheck order before confirm
     *
     * @return RedirectResponse | view
     */
    public function order_confirm()
    {
        if (!(\Session::has('total') && (\Session::get('total') > 0))) {
            alert()->error(__('Error'), __('No item in order'));
            return redirect()->route('admin.order.create');
        }

        $customers = Customer::get();
        return view('admin.order.confirm', [
            'customers' => $customers
        ]);
    }

    /**
     * Save order
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function order_save(Request $request)
    {
        if (!(\Session::has('total') && (\Session::get('total') > 0))) {
            alert()->error(__('Error'), __('No item in order'));
            return redirect()->route('admin.order.create');
        }

        $request->validate([
            "customer" => 'required|exists:customers,id',
            "vessel_name" => 'required|min:2|max:255',
        ]);

        $product_list = $this->order_to_array();

        $order = new Order();
        $order->total_price = $request->session()->get('total');
        $order->vessel_name = $request->vessel_name;
        $order->customer_id = $request->customer;
        $order->status_id = 3;
        $order->user_id = auth()->user()->id;
        $order->save();

        $order->product()->attach($product_list);
        $order->statusDate()->attach([
            'status_id' => 3
        ]);

        \Session::forget('total');
        \Session::forget('order');

        alert()->success(__('Success'), __('Add new order success'));
        return redirect()->route('admin.order.index');
    }

    /**
     * View order
     *
     * @param $id
     * @return View
     */
    public function order_view($id)
    {
        $order = Order::with('product.category', 'statusDate', 'user', 'customer.user')->find($id);

        $statuses = Status::where('id', '>', 3)
            ->where('id', '<', 9)
            ->where('id', '>', $order->status_id)
            ->get();

        return view('admin.order.show', [
            'order' => $order,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update order status
     *
     * @param $id
     * @return RedirectResponse
     */
    public function order_update_status($id)
    {
        $order = Order::where('id', $id)
            ->where('status_id', '<', 8)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.order.index');
        }

        if ($order->status_id == 2 || $order->status_id == 3) {
            if (!$order->purchase_order_number) {
                alert()->error(__('Error'), __('No data that you request'));
                return redirect()->route('admin.order.index');
            }
            $order->status_id = 4;
            $order->save();
            $order->statusDate()->attach([
                'status_id' => 4
            ]);
        } elseif ($order->status_id > 3 && $order->status_id < 8) {
            $order->status_id = $order->status_id + 1;
            $order->save();
            $order->statusDate()->attach([
                'status_id' => $order->status_id
            ]);
        }

        alert()->success(__('Success'), __('Update status for order :order success', ['order' => $order->order_number]));
        return redirect()->back();
    }

    /**
     * Save po data before update status
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function order_update_status_confirm(Request $request, $id)
    {
        $rules = [
            'purchase_order_number' => 'required|min:5',
        ];

        if ($request->purchase_order_file) {
            $rules['purchase_order_file'] = 'mimes:jpeg,png,pdf';
        }

        $request->validate($rules);

        $order = Order::find($id);
        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.product.index');
        }

        $order->purchase_order_number = $request->purchase_order_number;
        if ($request->purchase_order_file) {
            $url = Storage::disk('public')->put(null, $request->purchase_order_file);
            $order->purchase_order_file = 'uploads/' . $url;
        }
        $order->save();

        return $this->order_update_status($id);
    }

    /**
     * Cancel order
     *
     * @param $id
     * @return RedirectResponse
     */
    public function order_cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('status_id', '>', 2)
            ->where('status_id', '<', 5)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.order.index');
        }

        $order->status_id = 9;
        $order->save();
        $order->statusDate()->attach([
            'status_id' => 9
        ]);

        alert()->success(__('Success'), __('Cancel order :order success', ['order' => $order->order_number]));
        return redirect()->back();

    }

    /**
     * Convert order list from Category->product to Product_id list to friendly with eloquence
     *
     * @return array
     */
    protected function order_to_array()
    {
        $new_order = \Session::get('order');
        $product_list = [];
        foreach ($new_order as $cat_key => $category) {
            foreach ($category['products'] as $product_key => $product) {
                $product_list[] = [
                    'product_id' => $product_key,
                    'quantity' => $product['quantity'],
                    'price' => $product['price_no_vat']
                ];
            }
        }

        return $product_list;
    }

    /**
     * Response if success
     *
     * @return JsonResponse
     */
    private function responseSuccess($message)
    {
        $order = \Session::get('order');
        $res = null;
        foreach ($order as $key => $category) {
            if ( (int) $category['total'] == $category['total']) {
                $res['category'][$key] = number_format($category['total']);
            } else {
                $res['category'][$key] = number_format($category['total'], 2);
            }
        }

        if ( (int) \Session::get('total') == \Session::get('total')) {
            $res['total'] = number_format(\Session::get('total'));

        } else {
            $res['total'] = number_format(\Session::get('total'), 2);
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $res
        ]);
    }

    /**
     * Get action button
     *
     * @param $order
     * @return string
     */
    private function get_action_on_table($order)
    {
        $action = '';
        $status = null;
        $route = route('admin.order.update.status', $order->id);
        $view = '<a type="button" href="' . route('admin.order.call', [$order->id, 'view']) . '" class="btn btn-primary btn-sm">' . __('View') . '</a>';

        if ($order->status_id == 2 || $order->status_id == 3) {
            $status = Status::find(4);
        } elseif ($order->status_id > 3 && $order->status_id < 8) {
            $status = Status::find($order->status_id + 1);
        }

        if ($status) {
            $action = '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Action Button</span>
                      </button><div class="dropdown-menu">';
            if ($order->status_id == 2 || $order->status_id == 3) {
                $action .= '<a class="dropdown-item" href="' . route('admin.quote.edit', $order->id) . '">' . __('Edit') . ' Quote</a>' .
                    '<div class="dropdown-divider"></div>';
            }
            if ($status->id != 4) {
                $action .= '<a class="dropdown-item" href="' . $route . '">' . $status->status . '</a>';
            } else {
                $action .= '<a class="dropdown-item" onclick="confirm_order(\'' . route('admin.order.update.status', $order->id) . '\')" href="javascript:void(0)">' . $status->status . '</a>';
            }
        }

        if ($order->status_id > 2 && $order->status_id < 5) {
            if ($status) {
                $action .= '<div class="dropdown-divider"></div>';
            }
            $action .= '<a type="button" class="dropdown-item" href="' . route('admin.order.cancel', $order->id) . '">' . __('Cancel') . '</a>';
            if ($status) {
                $action .= '</div>';
            }
        }

        return $this->get_print_on_table($order) . '<div class="btn-group mb-2" role="group" aria-label="action group">
                 ' . $view . $action . '
                </div>';
    }

    /**
     * Get print button
     *
     * @param $order
     * @return string
     */
    public function get_print_on_table($order)
    {
        $action = '';
        if ($order->status_id >= 2 && auth()->user()->position != 'employee') {
            $action .= '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'quote']) . '">Quote</a>';
        }

        if ($order->status_id >= 4 && $order->purchase_order_file) {
            $action .= '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'po']) . '">Purchase Order</a>';
        }

        if ($order->status_id >= 5 && auth()->user()->position == 'admin') {
            $action .= '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'supply']) . '">Order supplier list</a>';
        }

        if ($order->status_id >= 6 && auth()->user()->position == 'admin') {
            $action .= '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'do']) . '">Delivery Order</a>';
        }

        if ($order->status_id == 7 && auth()->user()->position != 'employee') {
            $action .= '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'invoice']) . '">Invoice</a>';
        }

        if ($action) {
            return '<div class="btn-group btn-group-sm mr-2 mb-2" role="group" aria-label="Button group with nested dropdown">
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Print
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              ' . $action . '
                            </div>
                          </div>
                        </div>';
        } else {
            return null;
        }
    }

    /**
     * Get status label
     *
     * @param $order
     * @return string
     */
    public function get_status_label($order)
    {
        $color = 'bg-warning';
        if ($order->status->id > 3) {
            $color = 'bg-primary text-white';
        }
        if ($order->status->id > 5) {
            $color = 'bg-success text-white';
        }
        if ($order->status->id > 7) {
            $color = 'bg-success text-white';
        }
        return '<span class="' . $color . ' px-1 rounded">' . $order->status->status . '</span>';
    }

    /**
     * Check permission to access order data
     *
     * @param $id
     * @return bool
     */
    public function check_order_access($id)
    {
        $order = $order = Order::where('id', $id)->first();
        return $order ? true : false;
    }

    /**
     * Check permission and call to print quotation
     *
     */
    public function call_to_endpoint($id, $doc)
    {
        $order = $this->check_order_access($id);

        // Avoid doc from employee
        $employee_check = (strtolower($doc) !== 'view' && auth()->user()->position == 'employee');

        // Set supplier list to admin only
        $supplier_list = strtolower($doc) == 'supply' && auth()->user()->position != 'admin';

        if (!$order || $employee_check || $supplier_list) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

        switch (strtolower($doc)) {
            case 'view':
                return $this->order_view($id);
            case 'quote':
                return (new DocController)->print_quotation($id);
            case 'po':
                return (new DocController)->get_purchase_order_file($id);
            case 'supply':
                return (new DocController)->get_order_supplier_list($id);
            case 'do':
                return (new DocController)->print_delivery_order($id);
            case 'invoice':
                return (new DocController)->print_invoice($id);
            default:
                return abort(404);
        }
    }

    public function quote_edit($id)
    {
        $order = Order::with('product')->where('id', $id)->first();

        if (!$order || ($order->status_id !== 2 && $order->status_id !== 3)) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.order.index');
        }

        return view('admin.order.edit', [
            'order' => $order
        ]);
    }

    public function quote_price_update(Request $request, $id, $product)
    {
        $order = Order::find($id);

        if (!$order || ($order->status_id !== 2 && $order->status_id !== 3)) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        $product_data = Product::find($product);
        if (!$product_data || ($request->price < ($product_data->price/2) || $request->price > $product_data->price)) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        $order->product()->updateExistingPivot( $product , [
            'price' => $request->price
        ]);

        $total_amount = $this->quote_update_total_price($order->id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'product' => $product,
                'price' => (int) $request->price == $request->price
                            ? number_format($request->price)
                            : number_format($request->price, 2),
                'total_amount' => number_format($total_amount, 2)
            ]
        ]);
    }

    public function quote_price_discount(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order || ($order->status_id !== 2 && $order->status_id !== 3)) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        if ($request->discount < 0 || $request->discount > $order->total_price) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        $order->discount = $request->discount;
        $order->save();

        $total_amount = $this->quote_update_total_price($order->id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'total_amount' => number_format($total_amount, 2)
            ]
        ]);
    }

    private function quote_update_total_price($id)
    {
        $order = Order::with('product')->find($id);
        $total_amount = 0;

        foreach ($order->product as $product)
        {
            $total_amount +=  $product->calculate->total_amount;
        }

        if ($order->discount) {
            $total_amount -= $order->discount;
        }

        $order->total_price = $total_amount;
        $order->save();

        return $total_amount;
    }
}

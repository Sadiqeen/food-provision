<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Order;
use App\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $orders = Order::with('customer')->get();
        return datatables()->of($orders)
            ->addColumn('order_number', function ($orders) {
                return 'OD-' . str_pad($orders->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($orders->customer_id, 3, '0', STR_PAD_LEFT);
            })
            ->addColumn('customer', function ($orders) {
                return $orders->customer->name;
            })
            ->addColumn('status', function ($orders) {
                return '<span class="bg-warning px-1 rounded">New Order</span>';
            })
            ->addColumn('total_price', function ($orders) {
                return '<span class="bg-danger text-white px-1 rounded">' . number_format($orders->total_price) . '</span>';
            })
            ->addColumn('action', function ($orders) {
                return '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                  <button type="button" class="btn btn-primary btn-sm">' . __('View') . '</button>
                  <button type="button" class="btn btn-primary btn-sm">' . __('Edit') . '</button>

                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . __('Status') . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="javascript:void(0)">Receive Order</a>
                      <a class="dropdown-item" href="javascript:void(0)">Gather Food</a>
                      <a class="dropdown-item" href="javascript:void(0)">Ready for delivery</a>
                      <a class="dropdown-item" href="javascript:void(0)">Complete</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="javascript:void(0)">Cancel</a>
                    </div>
                  </div>
                </div>';
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
            alert()->info(__('No Customer'), __('Please create customer data before make an order'));
            return redirect()->route('admin.customer.create');
        }

        $categories = Category::get();

        if (!$categories->count()) {
            alert()->info(__('No Category'), __('Please create category data before make an order'));
            return redirect()->route('admin.category.index');
        }

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
                return '<div class="w-100 text-center">
                                <span class="bg-danger text-white px-1 rounded">' . number_format($product->price) . '</span>
                            </div>';
            })
            ->addColumn('value', function ($product) {
                $quantity = 0;
                if ( isset( \Session::get('order')[$product->category_id]['products'][$product->id] ) ) {
                    $quantity = \Session::get('order')[$product->category_id]['products'][$product->id]['quantity'];
                }
                return $quantity;
            })
            ->addColumn('quantity', function ($product) {
                $quantity = 0;
                if ( isset( \Session::get('order')[$product->category_id]['products'][$product->id] ) ) {
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
                    $order = $request->session()->get('order');
                    $order[$product->category_id]['products'][$product->id]['quantity'] = $request->quantity;
                    $request->session()->put('order', $order);
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
    private function is_in_order($product)
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
    private function add_product_to_order($product, $quantity)
    {
        $order = \Session::get('order');

        $order[$product->category->id]['name'] = $product->category->name;
        $order[$product->category->id]['products'][$product->id] = [
            'name_en' => $product->name_en,
            'name_th' => $product->name_th,
            'unit' => $product->unit->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $quantity
        ];

        \Session::put('order', $order);
    }

    protected function del_product_from_order($product)
    {
        $order = \Session::get('order');
        unset($order[$product->category->id]['products'][$product->id]);

        \Session::put('order', $order);
    }

    /**
     * Update price
     */
    private function update_price()
    {
        $order = \Session::get('order');

        $total = 0;
        foreach ($order as $key => $each_category)
        {
            $price = 0;
            foreach ($each_category['products'] as $product)
            {
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
        if (!(\Session::has('total') && (\Session::get('total') > 0)))
        {
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
        if (!(\Session::has('total') && (\Session::get('total') > 0)))
        {
            alert()->error(__('Error'), __('No item in order'));
            return redirect()->route('admin.order.create');
        }

        $request->validate([
            "customer" => 'required|exists:customers,id',
            "vessel_name" => 'required|min:2|max:255',
        ]);

        $new_order = $request->session()->get('order');
        foreach ($new_order as $cat_key => $category) {
            foreach ($category['products'] as $product_key => $product) {
                $product_list[] = [
                    'product_id' => $product_key,
                    'quantity' => $product['quantity']
                ];
            }
        }


        $order = new Order();
        $order->total_price = $request->session()->get('total');
        $order->vessel_name = $request->vessel_name;
        $order->customer_id = $request->customer;
        $order->status = 1;
        $order->save();

        $order->product()->attach($product_list);

        \Session::forget('total');
        \Session::forget('order');

        alert()->success(__('Success'), __('Add new order success'));
        return redirect()->route('admin.order.index');
    }

    /**
     * Order detail store
     *
     * @param Request $request
     */
    public function order_detail_store(Request $request)
    {
        $request->validate([
            'customer' => 'required|exists:customers,id',
            'vessel_name' => 'required|min:2|max:255',
        ]);
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
        foreach ($order as $key => $category)
        {
            $res['category'][$key] = number_format($category['total']);
        }

        $res['total'] = number_format(\Session::get('total'));

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $res
        ]);
    }

}

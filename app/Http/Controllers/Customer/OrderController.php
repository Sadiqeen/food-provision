<?php

namespace App\Http\Controllers\Customer;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Admin\OrderController as AdminOrder;

class OrderController extends AdminOrder
{
    /**
     * Show all order
     *
     * @returns View
     */
    public function index()
    {
        return view('customer.order.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $orders = Order::with('status')
                    ->where('customer_id', auth()->user()->customer_id)
                    ->where('status_id', '<', 7)
                    ->get();
        return datatables()->of($orders)
            ->addColumn('order_number', function ($orders) {
                return 'OD-' . str_pad($orders->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($orders->customer_id, 3, '0', STR_PAD_LEFT);
            })
            ->addColumn('status', function ($orders) {
                return $this->get_status_label($orders);
            })
            ->addColumn('total_price', function ($orders) {
                return '<span class="bg-danger text-white px-1 rounded">' . number_format($orders->total_price) . '</span>';
            })
            ->addColumn('action', function ($orders) {
                return $this->get_action_on_table($orders);
            })
            ->escapeColumns([])->toJson();
    }

    /**
     * Show product list to customer
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $productClass = Product::with('category', 'unit');

        if ($request->input('category') && $request->input('category') != 'All') {
            $productClass->whereHas('category', function($query) use($request) {
                $query->where('name', 'like', '%' . $request->input('category') . '%');
            });
        }

        if ($request->input('sort')) {
            switch ($request->input('sort')) {
                case "Z-A":
                    if (app()->getLocale() == "th") {
                        $productClass->orderBy('name_th', 'DESC');
                    } else {
                        $productClass->orderBy('name_en', 'DESC');
                    }
                    break;
                case "Price Min to Max":
                    $productClass->orderBy('price', 'ASC');
                    break;
                case "Price Max to Min":
                    $productClass->orderBy('price', 'DESC');
                    break;
                default:
                    if (app()->getLocale() == "th") {
                        $productClass->orderBy('name_th', 'ASC');
                    } else {
                        $productClass->orderBy('name_en', 'ASC');
                    }
            }
        }

        if ($request->input('search')) {
            if (app()->getLocale() == "th") {
                $productClass->where('name_th', 'like', '%' . $request->input('search') . '%');
            } else {
                $productClass->where('name_en', 'like', '%' . $request->input('search') . '%');
            }
        }

        $products = $productClass->paginate(12);

        if (!$products) {
            alert()->error(__('Error'), __('No product fount'));
        }

        return view('customer.order.create', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    /**
     * Add new item to cart
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function add_item(Request $request, $id)
    {
        $request->validate([
            "quantity" => 'required|min:1|numeric',
        ]);

        $product = Product::with('category', 'unit')->find($id);
        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.create');
        }

        $this->add_product_to_order($product, $request->quantity);
        $this->update_price();

        alert()->success(__('Success'), __('Add :product to order', ['product' => $product->name]));
        return redirect()->back();
    }

    /**
     * Update item in cart
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_item(Request $request, $id)
    {
        $request->validate([
            "quantity" => 'required|min:0|numeric',
        ]);

        $product = Product::with('category', 'unit')->find($id);
        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->back();
        }

        if ($this->is_in_order($product) && ($request->quantity > 0)) {
            // update quantity
            $this->update_product_quantity($product, $request->quantity);
            $this->update_price();
            alert()->success(__('Success'), __('Update quantity of :product', ['product' => $product->name]));
            return redirect()->back();
        } elseif ($this->is_in_order($product) && ($request->quantity == 0)) {
            // Delete item from order
            $this->del_product_from_order($product);
            $this->update_price();
            alert()->success(__('Success'),__('Remove :product from order', ['product' => $product->name]));
            return redirect()->back();
        } else {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->back();
        }
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
        alert()->success(__('Success'),__('Remove :product from order', ['product' => $product->name]));
        return redirect()->back();
    }

    /**
     * Show cart
     */
    public function cart()
    {
        if (!(\Session::has('total') && (\Session::get('total') > 0)))
        {
            alert()->error(__('Error'), __('No item in order'));
            return redirect()->route(auth()->user()->position . '.order.create');
        }

        return view('customer.order.confirm');
    }

    /**
     * Save new order to DB
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function order_save(Request $request)
    {
        if (!(\Session::has('total') && (\Session::get('total') > 0)))
        {
            alert()->error(__('Error'), __('No item in order'));
            return redirect()->route(auth()->user()->position . '.order.create');
        }

        $request->validate([
            "vessel_name" => 'required|min:2|max:255',
        ]);

        $product_list = $this->order_to_array();

        $order = new Order();
        $order->total_price = $request->session()->get('total');
        $order->vessel_name = $request->vessel_name;
        $order->customer_id = auth()->user()->customer_id;
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
        return redirect()->route(auth()->user()->position . '.order.index');
    }

    /**
     * Update order status
     *
     * @param $id
     * @return RedirectResponse
     */
    public function order_update_status($id)
    {
        $order = Order::where('id', $id)->where('customer_id', auth()->user()->customer_id)->first();
        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.order.index');
        }

        if ($order->status_id < 3) {
            $order->status_id = 3;
            $order->save();

            $order->statusDate()->attach([
                'status_id' => 3
            ]);
        } elseif ($order->status_id == 5) {
            $order->status_id = 6;
            $order->save();

            $order->statusDate()->attach([
                'status_id' => 6
            ]);
        }

        $order_id = 'OD-'
            . str_pad($order->id, 3, '0', STR_PAD_LEFT) . '-'
            . str_pad($order->customer_id, 3, '0', STR_PAD_LEFT);
        alert()->success(__('Success'), __('Update status for order :order success', ['order' => $order_id]));
        return redirect()->back();
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
            ->where('customer_id', auth()->user()->customer_id)
            ->where('status_id', '<', 4)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.order.index');
        }

        $order->status_id = 9;
        $order->save();
        $order->statusDate()->attach([
            'status_id' => 9
        ]);

        $order_id = 'OD-'
            . str_pad($order->id, 3, '0', STR_PAD_LEFT) . '-'
            . str_pad($order->customer_id, 3, '0', STR_PAD_LEFT);
        alert()->success(__('Success'), __('Cancel order :order success', ['order' => $order_id]));
        return redirect()->back();

    }

    /**
     * Check user permission before show order
     *
     * @param $id
     * @return RedirectResponse|View
     */
    public function call_order_view($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', auth()->user()->customer_id)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.order.index');
        }

        return $this->order_view($id);
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
        $route = route('customer.order.update.status', $order->id);
        $view = '<a type="button" href="' . route('customer.order.view', $order->id) . '" class="btn btn-secondary btn-sm">' . __('View') . '</a>';

        if ($order->status_id < 3) {
            $status = Status::find(3);
        } elseif ($order->status_id == 5) {
            $status = Status::find(6);
        }

        if ($status) {
            $action = '<a type="button" class="btn btn-primary btn-sm" href="' . $route . '">' . $status->status . '</a>';
        }

        if ($order->status_id < 4)
        {
            $action .= '<a type="button" class="btn btn-danger btn-sm" href="' . route('customer.order.cancel', $order->id) . '">' . __('Cancel') . '</a>';
        }

        return  '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                 ' . $view . $action . '
                </div>';
    }
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Order;
use App\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Customer\OrderController as CustomerOrder;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends CustomerOrder
{
    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $orders = Order::with('status')
                    ->where('user_id', auth()->user()->id)
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
        $order->status_id = 1;
        $order->user_id = auth()->user()->id;
        $order->save();

        $order->product()->attach($product_list);
        $order->statusDate()->attach([
            'status_id' => 1
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
        $order = Order::where('id', $id)
            ->where('status_id', '<', 6)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.order.index');
        }

        if ($order->status_id == 5) {
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
     * Check user permission before show order
     *
     * @param $id
     * @return RedirectResponse|View
     */
    public function call_order_view($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->user()->id)
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
       $route = route('employee.order.update.status', $order->id);
       $view = '<a type="button" href="' . route('employee.order.view', $order->id) . '" class="btn btn-secondary btn-sm">' . __('View') . '</a>';

       if ($order->status_id == 5) {
            $status = Status::find(6);
            $action = '<a type="button" class="btn btn-primary btn-sm" href="' . $route . '">' . $status->status . '</a>';
        } else {
            $action = '';
        }

       return  '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                 ' . $view . $action . '
                </div>';
    }
}

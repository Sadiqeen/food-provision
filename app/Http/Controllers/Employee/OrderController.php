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
            ->where('status_id', '<', 7)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('employee.order.index');
        }

        if ($order->status_id == 1) {
            $order->status_id = 11;
            $order->save();

            $order->statusDate()->attach([
                'status_id' => 11
            ]);
        }

        if ($order->status_id == 6) {
            $order->status_id = 7;
            $order->save();

            $order->statusDate()->attach([
                'status_id' => 7
            ]);
        }

        alert()->success(__('Success'), __('Update status for order :order success', ['order' => $order->order_number]));
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
            ->where('status_id',  1)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$order) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('customer.order.index');
        }

        $order->status_id = 11;
        $order->save();
        $order->statusDate()->attach([
            'status_id' => 11
        ]);

        alert()->success(__('Success'), __('Cancel order :order success', ['order' => $order->order_number]));
        return redirect()->back();

    }

    /**
     * Get action button
     *
     * @param $order
     * @return string
     */
    public function get_action_on_table($order)
    {
       $route = route('employee.order.update.status', $order->id);
       $view = '<a type="button" href="' . route('employee.order.call',[$order->id, 'view']) . '" class="btn btn-secondary btn-sm">' . __('View') . '</a>';
       $cancel = '';

        if (in_array($order->status_id, [1]))
        {
            $cancel .= '<a type="button" class="btn btn-danger btn-sm" href="' . route('employee.order.cancel', $order->id) . '">' . __('Cancel') . '</a>';
        }

       if ($order->status_id == 6) {
            $status = Status::find(7);
            $action = '<a type="button" class="btn btn-primary btn-sm" href="' . $route . '">' . $status->status . '</a>';
        } else {
            $action = '';
        }

       return  '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                 ' . $view . $action . $cancel . '
                </div>';
    }
}

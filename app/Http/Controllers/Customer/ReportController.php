<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ReportController as AdminReport;
class ReportController extends AdminReport
{
    public function index(Request $request)
    {
        return view('admin.Report.index');
    }

    public function history_api(Request $request)
    {
        $orders = Order::with('customer', 'status')
            ->where('status_id', '>=', 8)
            ->where('customer_id', auth()->user()->customer_id);

        return datatables()->of($orders->get())
            ->addColumn('order_number', function ($order) {
                $route = route('customer.order.call', [$order->id, 'view']);
                return '<a class="btn btn-link" href="' . $route . '">' . $order->order_number . '</a>';
            })
            ->addColumn('customer', function ($orders) {
                return $orders->customer->name;
            })
            ->addColumn('status', function ($orders) {
                return $this->get_status_label($orders);
            })
            ->addColumn('total_price', function ($orders) {
                return '<span class="bg-warning px-1 rounded">' . number_format($orders->total_price) . '</span>';
            })
            ->addColumn('updated_at', function ($orders) {
                return $orders->updated_at->format('d/m/Y');
            })
            ->escapeColumns([])->toJson();
    }
}

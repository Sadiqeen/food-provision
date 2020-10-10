<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (strtolower($request->customer) != 'all') {
                $start_range = Order::orderBy('updated_at', 'ASC')
                    ->where('customer_id', $request->customer)
                    ->first();
                if (!$start_range) {
                    $start_range = date('Y-M-d  H:i:s');
                }

                $end_range = Order::orderBy('updated_at', 'DESC')
                    ->where('customer_id', $request->customer)
                    ->first();

                if (!$end_range) {
                    $end_range = date('Y-M-d  H:i:s');
                }
            } else {
                $start_range = Order::orderBy('updated_at', 'ASC')->first();
                $end_range = Order::orderBy('updated_at', 'DESC')->first();
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'start_range' => isset($start_range->updated_at) ? $start_range->updated_at : $start_range,
                    'end_range' => isset($end_range->updated_at) ? $end_range->updated_at : $end_range,
                ]
            ]);
        }

        $start_range = Order::orderBy('updated_at', 'ASC')->first();
        $end_range = Order::orderBy('updated_at', 'DESC')->first();
        $customers = Customer::whereHas('order', function ($query) {
            $query->where('status_id', '>=', 8);
        })->get();
        return view('admin.Report.index', [
            'customers' => $customers,
            'start_range' => $start_range,
            'end_range' => $end_range,
        ]);
    }

    public function history_api(Request $request)
    {
        $orders = Order::with('customer', 'status')
            ->where('status_id', '>=', 8);

        if ($request->input('customer') && strtolower($request->input('customer')) != 'all') {
            $orders->where('customer_id', $request->input('customer'));
        }

        if ($request->input('start_date') && $request->input('end_date')) {
            $from = date($request->input('start_date'));
            $to = date($request->input('end_date') . ' 23:59:00');
            $orders->whereBetween('updated_at', [
                $from, $to]);
        }

        return datatables()->of($orders->get())
            ->addColumn('order_number', function ($order) {
                $route = route('admin.order.call', [$order->id, 'view']);
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

    public function export(Request $request)
    {
        $orders = Order::with('customer', 'status')
            ->where('status_id', '>=', 8);

        if ($request->input('customer') && strtolower($request->input('customer')) != 'all') {
            $orders->where('customer_id', $request->input('customer'));
        }

        if ($request->input('start_date') && $request->input('end_date')) {
            $from = date($request->input('start_date'));
            $to = date($request->input('end_date') . ' 23:59:00');
            $orders->whereBetween('updated_at', [
                $from, $to]);
        }

        return \Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }

    public function get_status_label($order)
    {
        $color = 'bg-warning';

        if ($order->status->id >= 8) {
            $color = 'bg-success text-white';
        }

        if ($order->status->id >= 9) {
            $color = 'bg-danger text-white';
        }
        return '<span class="' . $color . ' px-1 rounded">' . $order->status->status . '</span>';
    }
}

<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Supplier;
use App\User;
use Illuminate\View\View;
use App\Product;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	//
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {
        //Admin

        if (auth()->user()->position == 'admin') {
            $graph = new GraphController();

            $sale_result_average = $graph->get_sale_result_average();
            $most_spendors = $graph->get_most_spendors();

            $order = Order::where('status_id', 3)
                ->orWhere('status_id', 4)
                ->count();
            $product = Product::count();
            $supplier = Supplier::count();
            $customer = Customer::count();

            return view('admin.dashboad', [
                'order' => $order,
                'product' => $product,
                'supplier' => $supplier,
                'customer' => $customer,
                'sale_result_average' => $sale_result_average,
                'most_spendors' => $most_spendors,
            ]);
        }

        // Customer

        if (auth()->user()->position == 'customer') {
            $vessel_request = Order::where('customer_id', auth()->user()->customer_id)
                ->where('status_id',  1)->count();
            $success = Order::where('customer_id', auth()->user()->customer_id)
                ->where('status_id', 8)->count();
            $cancel = Order::where('customer_id', auth()->user()->customer_id)
                ->where('status_id', '>', 8)->count();
            $employee = User::where('customer_id', auth()->user()->customer_id)
                ->where('position', 'employee')->count();
            return view('customer.dashboad', [
                'vessel_request' => $vessel_request,
                'success' => $success,
                'cancel' => $cancel,
                'employee' => $employee,
            ]);
        }

        // Employee

        if (auth()->user()->position == 'employee') {
            return redirect()->route('employee.order.create');
        }
    }
}

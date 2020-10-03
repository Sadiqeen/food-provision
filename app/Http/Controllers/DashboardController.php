<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Supplier;
use Illuminate\Http\Request;
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
            $order = Order::where('status', 1)->count();
            $product = Product::count();
            $supplier = Supplier::count();
            $customer = Customer::count();

            return view('admin.dashboad', [
                'order' => $order,
                'product' => $product,
                'supplier' => $supplier,
                'customer' => $customer,
            ]);
        }

        // Customer

        if (auth()->user()->position == 'customer') {
            $order = Order::where('status', 1)->where('customer_id', auth()->user()->id)->count();

            return view('customer.dashboad', [
                'order' => $order,
            ]);
        }

        if (auth()->user()->position == 'employee') {
            $order = Order::where('status', 1)->where('customer_id', auth()->user()->id)->count();

            return view('employee.dashboad', [
                'order' => $order,
            ]);
        }
    }
}

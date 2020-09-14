<?php

namespace App\Http\Controllers;

use App\Customer;
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
        $product = Product::count();
        $supplier = Supplier::count();
        $customer = Customer::count();

        return view('admin.dashboad', [
            'product' => $product,
            'supplier' => $supplier,
            'customer' => $customer,
        ]);
    }
}

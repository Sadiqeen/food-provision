<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    /*
     * index page
     *
     * @return View
     */
    public function index()
    {
        return view('admin.order.index');
    }
}

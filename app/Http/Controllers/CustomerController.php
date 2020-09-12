<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $customer = Customer::get();
        return datatables()->of($customer)
            ->addColumn('action', function ($customer) {
                $view = '<a href="javascript:void(0)" onclick="viewCustomer(\'' . route('admin.customer.show', $customer->id) . '\')" class="text-primary mr-3"><i class="fa fa-eye fa-lg"></i></a>';
                $edit = '<a href="' . route('admin.customer.edit', $customer->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                $delete = '<a href="javascript:void(0)" onclick="delCustomer(\'' . route('admin.customer.destroy', $customer->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $view . $edit . $delete . '</div>';
            })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomer  $request
     * @return RedirectResponse
     */
    public function store(StoreCustomer $request)
    {
        Customer::create($request->all());
        alert()->success(__('Success'), __('New customer added to the system'));
        return redirect()->route('admin.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 'error',
                'message' => __('No data that you request'),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse | View
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.customer.index');
        }

        return view('admin.customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomer  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateCustomer $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.customer.index');
        }

        $customer->name = $request->name;
        $customer->coordinator = $request->coordinator;
        $customer->tel = $request->tel;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->note = $request->note;
        $customer->save();

        alert()->success(__('Success'), __('Customer data edited'));
        return redirect()->route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.customer.index');
        }

        $customer->delete();

        alert()->success(__('Success'), __('Customer deleted'));
        return redirect()->route('admin.customer.index');
    }
}
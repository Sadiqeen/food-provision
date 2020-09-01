<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Http\Requests\StoreSupplier;
use App\Http\Requests\UpdateSupplier;
use View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.supplier.index');
    }

    /**
     * Send data of index through API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $supplier = Supplier::query();
        return datatables()->of($supplier)
                    ->addColumn('action', function ($supplier) {
                        $view = '<a href="' . route('admin.supplier.show', $supplier->id) . '" class="text-primary mr-3"><i class="fa fa-eye fa-lg"></i></a>';
                        $edit = '<a href="' . route('admin.supplier.edit', $supplier->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delSupplier(\'' . route('admin.supplier.destroy', $supplier->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                        return '<div class="btn-group" role="group" aria-label="Basic example">' . $view . $edit . $delete . '</div>';
                    })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {
        Supplier::create($request->all());
        alert()->success(__('Success'), __('New supplier added to the system'));
        return redirect()->route('admin.supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.supplier.index');
        }

        return view('admin.supplier.show', ["supplier" => $supplier]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.supplier.index');
        }

        return view('admin.supplier.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplier $request, $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.supplier.index');
        }

        $supplier->name = $request->name;
        $supplier->tel = $request->tel;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        alert()->success(__('Success'), __('Supplier data edited'));
        return redirect()->route('admin.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.supplier.index');
        }

        $supplier->delete();

        alert()->success(__('Success'), __('Supplier deleted'));
        return redirect()->route('admin.supplier.index');
    }
}

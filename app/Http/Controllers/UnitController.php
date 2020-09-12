<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Http\Requests\StoreUnit;
use App\Http\Requests\UpdateUnit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.unit.index');
    }

    /**
     * Send data of index through API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $unit = Unit::withCount('product')->get();
        return datatables()->of($unit)
                    ->addColumn('product_count', function ($brands) {
                        return '<a role="button" href="' . route('admin.product.index') . '?query='. $brands->name . '">' . $brands->product_count . '</a>';
                    })
                    ->addColumn('action', function ($unit) {
                        $edit = '<a href="' . route('admin.unit.edit', $unit->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delBrand(\'' . route('admin.unit.destroy', $unit->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                        return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
                    })->escapeColumns([])->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnit $request)
    {
        Unit::create($request->all());
        alert()->success(__('Success'), __('New unit added to the system'));
        return redirect()->route('admin.unit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.unit.index');
        }

        return view('admin.unit.edit', ['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnit $request, $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.unit.index');
        }

        $unit->name = $request->name;
        $unit->save();

        alert()->success(__('Success'), __('Unit data edited'));
        return redirect()->route('admin.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.unit.index');
        }

        $unit->delete();

        alert()->success(__('Success'), __('Unit deleted'));
        return redirect()->route('admin.unit.index');
    }
}

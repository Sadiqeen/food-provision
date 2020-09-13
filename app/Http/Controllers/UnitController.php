<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Response;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.unit.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws Exception
     */
    public function index_api()
    {
        $unit = Unit::withCount('product')->get();
        return datatables()->of($unit)
                    ->addColumn('product_count', function ($unit) {
                        return '<a role="button" href="' . route('admin.product.index') . '?query='. $unit->name . '">' . $unit->product_count . '</a>';
                    })
                    ->addColumn('action', function ($unit) {
                        $edit = '<a href="javascript:void(0)" onclick="editUnit(\'' . route('admin.unit.update', $unit->id) . '\', \'' . $unit->name . '\')" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delBrand(\'' . route('admin.unit.destroy', $unit->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                        return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
                    })->escapeColumns([])->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "unit" => 'required|max:255|unique:units,name',
        ]);

        $unit = new Unit;
        $unit->name = $request->unit;
        $unit->save();

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
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.unit.index');
        }

        $validator = Validator::make($request->all(), [
            "unit_edit" => 'required|max:255|unique:units,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.unit.index')
                ->withErrors($validator)
                ->with('update_id',  $id)
                ->with('old_unit',  $unit->name)
                ->withInput();
        }

        $unit->name = $request->unit_edit;
        $unit->save();

        alert()->success(__('Success'), __('Unit data edited'));
        return redirect()->route('admin.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
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

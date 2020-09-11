<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrand;
use App\Http\Requests\UpdateBrand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index');
    }

    /**
     * Send data of index through API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $brands = Brand::withCount('product')->get();
        return datatables()->of($brands)
                    ->addColumn('action', function ($brands) {
                        $edit = '<a href="' . route('admin.brand.edit', $brands->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delBrand(\'' . route('admin.brand.destroy', $brands->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                        return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
                    })->toJson();
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
    public function store(StoreBrand $request)
    {
        Brand::create($request->all());
        alert()->success(__('Success'), __('New brand added to the system'));
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::find($id);

        if (!$brand) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.brand.index');
        }

        return view('admin.brand.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrand $request, $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.brand.index');
        }

        $brand->name_en = $request->name_en;
        $brand->name_th = $request->name_th;
        $brand->save();

        alert()->success(__('Success'), __('Brand data edited'));
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.brand.index');
        }

        $brand->delete();

        alert()->success(__('Success'), __('Brand deleted'));
        return redirect()->route('admin.brand.index');
    }
}

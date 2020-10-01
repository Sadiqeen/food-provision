<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Void_;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.brand.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws Exception
     */
    public function index_api()
    {
        $brands = Brand::withCount('product')->get();
        return datatables()->of($brands)
                    ->addColumn('product_count', function ($brands) {
                        return '<a role="button" href="' . route('admin.product.index') . '?query='. $brands->name . '">' . $brands->product_count . '</a>';
                    })
                    ->addColumn('action', function ($brands) {
                        $edit = '<a href="javascript:void(0)" onclick="editBrand(\'' . route('admin.brand.update', $brands->id) . '\', \'' . $brands->name . '\')"  class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delBrand(\'' . route('admin.brand.destroy', $brands->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
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
            "brand" => 'required|max:255|unique:brands,name',
        ]);

        $brand = new Brand;
        $brand->name = $request->brand;
        $brand->save();

        alert()->success(__('Success'), __('New brand added to the system'));
        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Void
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
     * @return Response | RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.brand.index');
        }

        $validator = Validator::make($request->all(), [
            "brand_edit" => 'required|max:255|unique:brands,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.brand.index')
                ->withErrors($validator)
                ->with('update_id',  $id)
                ->with('old_brand',  $brand->name)
                ->withInput();
        }

        $brand->name = $request->brand_edit;
        $brand->save();

        alert()->success(__('Success'), __('Brand data edited'));
        return redirect()->route('admin.brand.index');
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

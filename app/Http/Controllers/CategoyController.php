<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;

class CategoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Send data of index through API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $brands = Category::query();
        return datatables()->of($brands)
                    ->addColumn('action', function ($brands) {
                        $edit = '<a href="' . route('admin.category.edit', $brands->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delBrand(\'' . route('admin.category.destroy', $brands->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
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
    public function store(StoreCategory $request)
    {
        Category::create($request->all());
        alert()->success(__('Success'), __('New category added to the system'));
        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);

        if (!$category) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.category.index');
        }

        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.category.index');
        }

        $category->name_en = $request->name_en;
        $category->name_th = $request->name_th;
        $category->save();

        alert()->success(__('Success'), __('Category data edited'));
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.category.index');
        }

        $category->delete();

        alert()->success(__('Success'), __('Category deleted'));
        return redirect()->route('admin.category.index');
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CategoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request  $request)
    {
        return view('admin.category.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws Exception
     */
    public function index_api()
    {
        $category = Category::withCount('product')->get();
        return datatables()->of($category)
                    ->addColumn('product_count', function ($category) {
                        return '<a role="button" href="' . route('admin.product.index') . '?query='. $category->name . '">' . $category->product_count . '</a>';
                    })
                    ->addColumn('action', function ($category) {
                        $edit = '<a href="javascript:void(0)" onclick="editCategory(\'' . route('admin.category.update', $category->id) . '\', \'' . $category->name . '\')" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delCategory(\'' . route('admin.category.destroy', $category->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
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
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "category" => 'required|max:255|unique:categories,name',
        ]);

        $category = new Category;
        $category->name = $request->category;
        $category->save();

        alert()->success(__('Success'), __('New category added to the system'));
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
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
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.category.index');
        }

        $validator = Validator::make($request->all(), [
            "category_edit" => 'required|max:255|unique:categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.category.index')
                ->withErrors($validator)
                ->with('update_id',  $id)
                ->with('old_category',  $category->name)
                ->withInput();
        }

        $category->name = $request->category_edit;
        $category->save();

        alert()->success(__('Success'), __('Category data edited'));
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
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

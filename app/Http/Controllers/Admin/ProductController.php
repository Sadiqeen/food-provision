<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use App\Imports\ExcelImport;
use App\Product;
use App\Unit;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Send data of index through API.
     *
     * @return Response
     * @throws
     */
    public function index_api()
    {
        $product = Product::with(['brand', 'category', 'supplier', 'unit'])->get();
        return datatables()->of($product)
                    ->addColumn('name_en', function ($product) {
                        if ($product->vat) {
                            return $product->name_en . '&nbsp;&nbsp;<i  style="font-size: 0.6rem;" class="fa fa-percent bg-secondary text-white p-1 rounded-lg"></i>';
                        }
                        return $product->name_en;
                    })
                    ->addColumn('brand', function ($product) {
                        return $product->brand->name;
                    })
                    ->addColumn('supplier', function ($product) {
                        return $product->supplier->name;
                    })
                    ->addColumn('category', function ($product) {
                        return $product->category->name;
                    })
                    ->addColumn('unit', function ($product) {
                        return $product->unit->name;
                    })
                    ->addColumn('price', function ($product) {
                        return number_format($product->price);
                    })
                    ->addColumn('action', function ($product) {
                        $edit = '<a href="' . route('admin.product.edit', $product->id) . '" class="text-warning-dark mr-3"><i class="fa fa-pencil fa-lg"></i></a>';
                        $delete = '<a href="javascript:void(0)" onclick="delProduct(\'' . route('admin.product.destroy', $product->id) . '\')" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>';
                        return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
                    })
                    ->escapeColumns([])->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|View
     */
    public function create()
    {
        $units = Unit::all();

        if (!$units->count()) {
            alert()->info(__('No Product Unit'), __('Please create product unit data before create product'));
            return redirect()->route('admin.unit.index');
        }

        $brands = Brand::all();

        if (!$brands->count()) {
            alert()->info(__('No Product Brand'), __('Please create product brand data before create product'));
            return redirect()->route('admin.brand.index');
        }

        $categories = Category::all();

        if (!$categories->count()) {
            alert()->info(__('No Product Category'), __('Please create product category data before create product'));
            return redirect()->route('admin.category.index');
        }

        $suppliers = Supplier::all();

        if (!$suppliers->count()) {
            alert()->info(__('No Supplier'), __('Please create supplier data before create product'));
            return redirect()->route('admin.supplier.index');
        }

        return view('admin.product.create', [
            'units' => $units,
            'brands' => $brands,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return RedirectResponse
     */
    public function store(StoreProduct $request)
    {
        $product = new Product;
        $product->name_en = $request->name_en;
        $product->name_th = $request->name_th;
        $product->price = $request->price;
        $product->supplier_id = $request->supplier;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->vat = $request->vat ? true : false;

        if ($request->image) {
            $url = Storage::disk('public')->put(null, $request->image);
            $product->image = 'uploads/' . $url;
        }

        if ($request->description) {
            $product->desc = $request->description;
        }

        $product->save();

        alert()->success(__('Success'), __('New product added to the system'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $product = Product::with(['supplier', 'brand', 'category', 'unit'])->find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => __('No data that you request'),
            ]);
        }

        return response()->json([
                'status' => 'success',
                'data' => $product,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        $units = Unit::all();
        $brands = Brand::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $product = Product::find($id);

        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.product.index');
        }

        return view('admin.product.edit', [
                'units' => $units,
                'brands' => $brands,
                'categories' => $categories,
                'suppliers' => $suppliers,
                'product' => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProduct $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateProduct $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.product.index');
        }

        $product->name_en = $request->name_en;
        $product->name_th = $request->name_th;
        $product->price = $request->price;
        $product->supplier_id = $request->supplier;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->vat = $request->vat ? true : false;

        if ($request->image) {
            $url = Storage::disk('public')->put(null, $request->image);
            $product->image = 'uploads/' . $url;
        }

        if ($request->description) {
            $product->desc = $request->description;
        }

        $product->save();

        alert()->success(__('Success'), __('Product data edited'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route('admin.product.index');
        }

        $product->delete();

        alert()->success(__('Success'), __('Product deleted'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Show the form for upload exel.
     *
     * @return View
     */
    public function upload()
    {
        return view('admin.product.upload');
    }

    /**
     * import file exel and save to DB.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function import(Request $request)
    {
        $this->validate($request, [
//            'excel'  => 'required|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new ExcelImport, $request->excel);

        alert()->success(__('Success'), __('New product added to the system'));
        return redirect()->route('admin.product.index');
    }
}

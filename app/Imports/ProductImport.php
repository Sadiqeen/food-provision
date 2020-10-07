<?php

namespace App\Imports;

use App\Brand;
use App\Category;
use App\Product;
use App\Supplier;
use App\Unit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
    * @param Collection $rows
    *
    * @return void
    */
    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        array_splice($rows, 0, 2);

        Validator::make($rows, [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => 'required',
            '*.5' => 'required',
            '*.6' => 'required|numeric',
            '*.7' => 'required',
        ])->validate();

        for ( $i = 0 ; $i < count($rows) ; $i++ )
        {

            if (!$this->isExistProduct($rows[$i][1])) {
                $brand_id = $this->getOrCreateBrand($rows[$i][2]);
                $unit_id = $this->getOrCreateUnit($rows[$i][5]);
                $category_id = $this->getOrCreateCategory($rows[$i][3]);
                $supplier_id = $this->getSupplier($rows[$i][7]);
                $vat = $rows[$i][8] ? true : false;

                Product::create([
                    'name_th' => $rows[$i][0],
                    'name_en' => $rows[$i][1],
                    'price' => $rows[$i][6],
                    'desc' => $rows[$i][4],
                    'vat' => $vat,
                    'supplier_id' => $supplier_id,
                    'brand_id' => $brand_id,
                    'category_id' => $category_id,
                    'unit_id' => $unit_id,
                ]);
            }
        }
    }

    private function isExistProduct($product) {
        $product = Product::where('name_en', 'like', '%' . $product . '%')->first();
        if (!$product) {
            return false;
        }
        return true;
    }

    private function getSupplier($supplier) {
        $supplier = Supplier::where('name', 'like', '%' . $supplier . '%')->first();

        if (!$supplier) {
            abort(500);
        }

        return $supplier->id;
    }

    private function getOrCreateBrand($brand_param) {
        $brand = Brand::where('name', 'like', '%' . $brand_param . '%')->first();

        if (!$brand) {
            $brand = Brand::create([
                'name' => $brand_param
            ]);
        }

        return $brand->id;
    }

    private function getOrCreateUnit($unit_param) {
        $unit = Unit::where('name', 'like', '%' . $unit_param . '%')->first();

        if (!$unit) {
            $unit = Unit::create([
                'name' => $unit_param
            ]);
        }

        return $unit->id;
    }

    private function getOrCreateCategory($category_param) {
        $category = Category::where('name', 'like', '%' . $category_param . '%')->first();

        if (!$category) {
            $category = Category::create([
                'name' => $category_param
            ]);
        }

        return $category->id;
    }
}

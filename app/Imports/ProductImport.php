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

        $insert_data = [];

        for ( $i = 0 ; $i < count($rows) ; $i++ )
        {

            if (!$this->isExistProduct($rows[$i][1])) {
                $brand = Brand::firstOrCreate( ['name' => $rows[$i][2]] );
                $unit = Unit::firstOrCreate( ['name' => $rows[$i][5]] );
                $category = Category::firstOrCreate( ['name' => $rows[$i][3]] );
                $supplier_id = $this->getSupplier($rows[$i][7]);
                $vat = $rows[$i][8] ? true : false;

                $insert_data[] = [
                    'name_th' => $rows[$i][0],
                    'name_en' => $rows[$i][1],
                    'price' => $rows[$i][6],
                    'desc' => isset($rows[$i][4]) ? $rows[$i][4] : '',
                    'vat' => $vat,
                    'supplier_id' => $supplier_id,
                    'brand_id' => $brand->id,
                    'category_id' => $category->id,
                    'unit_id' => $unit->id,
                ];
            }
        }

        Product::insert($insert_data);
    }

    private function isExistProduct($product) {
        $product = Product::where('name_en', 'like', '%' . $product . '%')->first();
        if (!$product) {
            return false;
        }
        return true;
    }

    private function getSupplier($supplier) {
        $supplier_data = Supplier::where('name', 'like', '%' . $supplier . '%')->first();

        if (!$supplier_data) {
            abort(500, 'Supplier ' . $supplier .' not fount in the system.');
        }

        return $supplier_data->id;
    }
}

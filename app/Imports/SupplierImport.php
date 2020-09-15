<?php

namespace App\Imports;

use App\Brand;
use App\Product;
use App\Supplier;
use App\Unit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class SupplierImport implements ToCollection
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
        ])->validate();

        for ( $i = 0 ; $i < count($rows) ; $i++ )
        {
            if ($this->isSupplierExist($rows[$i][0])) {
                Product::create([
                    'name' => $rows[$i][0],
                    'tel' => $rows[$i][1],
                    'email' => $rows[$i][2],
                    'address' => $rows[$i][3],
                ]);
            }
        }
    }

    private function isSupplierExist($supplier_param) {
        $supplier = Supplier::where('name', 'like', '%' . $supplier_param . '%')->first();

        if (!$supplier) {
            return false;
        }

        return true;
    }

}

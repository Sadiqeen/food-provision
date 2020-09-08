<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
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
        for ( $i = 0 ; $i < count($rows) ; $i++ )
        {
            if ( $i !== 0 )
            {
                Product::create([
                    'name_en' => $rows[$i][0],
                    'name_th' => $rows[$i][1],
                    'price' => $rows[$i][2],
                    'desc_en' => $rows[$i][3],
                    'desc_th' => $rows[$i][4],
                    'supplier_id' => $rows[$i][5],
                    'brand_id' => $rows[$i][6],
                    'category_id' => $rows[$i][7],
                    'unit_id' => $rows[$i][8],
                ]);
            }
        }
    }
}

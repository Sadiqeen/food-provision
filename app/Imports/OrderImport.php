<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Product;
use App\Http\Controllers\Admin\OrderController;

class OrderImport implements ToCollection
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        array_splice($rows, 0, 10);

        for ($i = 0; $i < count($rows); $i++) {
            $product = null;
            if (isset($rows[$i][6]) && $rows[$i][6] > 0) {
                $product = Product::with('category', 'unit')
                    ->where('name_en', 'like', '%' . $rows[$i][2] . '%')
                    ->where('price', $rows[$i][7])
                    ->where('desc', 'like', '%' . $rows[$i][4] . '%')->first();
                if ($product) {
                    $order = new OrderController();
                    $order->add_product_to_order($product, $rows[$i][6]);
                    $order->update_price();
                }
            }
        }
    }
}

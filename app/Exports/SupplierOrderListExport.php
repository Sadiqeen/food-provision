<?php

namespace App\Exports;

use App\Supplier;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SupplierOrderListExport implements WithMultipleSheets
{
    use Exportable;

    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function sheets(): array
    {
        $sheets = [];
        $id = $this->id;

        $suppliers = Supplier::with(['product' => function($query) use($id) {
            $query->with('category','order','unit')
                ->whereHas('order',  function ($q) use($id) {
                    $q->where('orders.id', $id);
                })
                ->orderBy('category_id');
        }])->get();

        foreach ($suppliers as $supplier) {
            $sheets[] = new OrderPerSupplierSheet($supplier);
        }

        return $sheets;
    }
}

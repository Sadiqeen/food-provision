<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'products' => new ProductImport(),
        ];
    }
}

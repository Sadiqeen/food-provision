<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Category;

class ExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $categories = Category::all();
        $import_value = [];

        foreach ($categories as $category) {
            $import_value[$category->name] = new OrderImport();
        }

        return $import_value;
    }
}

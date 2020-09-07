<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Apple Fuji',
                'name_th' => 'แอ๊ปเปิ้ลฟูจิ',
                'price' => 1100,
                'image' => NULL,
                'desc_en' => '18 kg.',
                'desc_th' => NULL,
                'created_at' => '2020-09-07 02:16:14',
                'updated_at' => '2020-09-07 02:21:23',
                'supplier_id' => 21,
                'brand_id' => 1,
                'category_id' => 1,
                'unit_id' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Green, Apple',
                'name_th' => 'แอ๊ปเปิ้ล เขียว',
                'price' => 1450,
                'image' => NULL,
                'desc_en' => '18 kg.',
                'desc_th' => NULL,
                'created_at' => '2020-09-07 02:23:35',
                'updated_at' => '2020-09-07 02:23:35',
                'supplier_id' => 21,
                'brand_id' => 1,
                'category_id' => 1,
                'unit_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Pisang Emas',
                'name_th' => 'กล้วยไข่',
                'price' => 35,
                'image' => NULL,
                'desc_en' => NULL,
                'desc_th' => NULL,
                'created_at' => '2020-09-07 02:28:49',
                'updated_at' => '2020-09-07 02:28:49',
                'supplier_id' => 1,
                'brand_id' => 2,
                'category_id' => 1,
                'unit_id' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Small Banana ,Pisang Awak',
                'name_th' => 'กล้วยน้ำว้า ใหญ่',
                'price' => 27,
                'image' => NULL,
                'desc_en' => NULL,
                'desc_th' => NULL,
                'created_at' => '2020-09-07 02:32:00',
                'updated_at' => '2020-09-07 02:32:00',
                'supplier_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'unit_id' => 2,
            ),
            4 => 
            array (
                'id' => 5,
            'name_en' => 'Large Banana (Bunch)',
                'name_th' => 'กล้วยหอม ใหญ่',
                'price' => 38,
                'image' => NULL,
                'desc_en' => NULL,
                'desc_th' => NULL,
                'created_at' => '2020-09-07 02:32:53',
                'updated_at' => '2020-09-07 02:32:53',
                'supplier_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'unit_id' => 1,
            ),
        ));
        
        
    }
}
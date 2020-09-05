<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('brands')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name_en' => 'Local',
                'name_th' => 'ท้องถิ่น',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Imported',
                'name_th' => 'นำเข้า',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            2 =>
            array (
                'id' => 3,
                'name_en' => 'Sai nam pung',
                'name_th' => 'สายน้ำผึ้ง',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            3 =>
            array (
                'id' => 4,
                'name_en' => 'Meiji',
                'name_th' => 'เมจิ',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
        ));


    }
}

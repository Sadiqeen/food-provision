<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name_en' => 'Chiller',
                'name_th' => 'แช่เย็น',
                'created_at' => '2020-09-03 07:20:32',
                'updated_at' => '2020-09-03 07:20:32',
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Freezer',
                'name_th' => 'แช่แข็ง',
                'created_at' => '2020-09-03 07:20:32',
                'updated_at' => '2020-09-03 07:20:32',
            ),
            2 =>
            array (
                'id' => 3,
                'name_en' => 'Dry',
                'name_th' => 'ของแห้ง',
                'created_at' => '2020-09-03 07:20:32',
                'updated_at' => '2020-09-03 07:20:32',
            ),
            3 =>
            array (
                'id' => 4,
                'name_en' => 'Drink',
                'name_th' => 'เครื่องดื่ม',
                'created_at' => '2020-09-03 07:20:32',
                'updated_at' => '2020-09-03 07:20:32',
            ),
        ));


    }
}

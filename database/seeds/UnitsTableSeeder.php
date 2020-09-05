<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('units')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name_en' => 'Case',
                'name_th' => 'กล่อง',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Kg',
                'name_th' => 'กิโลกรัม',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
            2 =>
            array (
                'id' => 3,
                'name_en' => 'Nos',
                'name_th' => '',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
            3 =>
            array (
                'id' => 4,
                'name_en' => 'Ea',
                'name_th' => 'ชิ้น',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
            4 =>
            array (
                'id' => 5,
                'name_en' => 'Cup',
                'name_th' => 'ถ้วย',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
            4 =>
            array (
                'id' => 5,
                'name_en' => 'Cup',
                'name_th' => 'ถ้วย',
                'created_at' => '2020-09-04 20:38:52',
                'updated_at' => '2020-09-04 20:38:52',
            ),
        ));


    }
}

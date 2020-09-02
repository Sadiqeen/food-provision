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
                'name_en' => 'Garment',
                'name_th' => 'ไทย_Gas Pumping Station Operator',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Film Laboratory Technician',
                'name_th' => 'ไทย_Welding Machine Tender',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            2 =>
            array (
                'id' => 3,
                'name_en' => 'Distribution Manager',
                'name_th' => 'ไทย_Horticultural Worker',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            3 =>
            array (
                'id' => 4,
                'name_en' => 'Custom Tailor',
                'name_th' => 'ไทย_Model Maker',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            4 =>
            array (
                'id' => 5,
                'name_en' => 'Announcer',
                'name_th' => 'ไทย_Cutting Machine Operator',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            5 =>
            array (
                'id' => 6,
                'name_en' => 'Makeup Artists',
                'name_th' => 'ไทย_Gluing Machine Operator',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            6 =>
            array (
                'id' => 7,
                'name_en' => 'Economist',
                'name_th' => 'ไทย_Entertainment Attendant',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            7 =>
            array (
                'id' => 8,
                'name_en' => 'Food Science Technician',
                'name_th' => 'ไทย_Operations Research Analyst',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            8 =>
            array (
                'id' => 9,
                'name_en' => 'Sheet Metal Worker',
                'name_th' => 'ไทย_Statistician',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
            9 =>
            array (
                'id' => 10,
                'name_en' => 'Punching Machine Setters',
                'name_th' => 'ไทย_Forging Machine Setter',
                'created_at' => '2020-09-02 19:45:28',
                'updated_at' => '2020-09-02 19:45:28',
            ),
        ));


    }
}

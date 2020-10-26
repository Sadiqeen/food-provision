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
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Chiller',
                'created_at' => '2020-10-26 09:39:52',
                'updated_at' => '2020-10-26 09:39:52',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Freezer',
                'created_at' => '2020-10-26 09:39:52',
                'updated_at' => '2020-10-26 09:39:52',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dry',
                'created_at' => '2020-10-26 09:39:53',
                'updated_at' => '2020-10-26 09:39:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Drink',
                'created_at' => '2020-10-26 09:39:53',
                'updated_at' => '2020-10-26 09:39:53',
            ),
        ));
        
        
    }
}
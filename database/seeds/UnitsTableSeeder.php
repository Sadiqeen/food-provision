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
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Case',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Kg',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Nos',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tub',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Ea',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pkt',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Cup',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Tray',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Pcs',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'PACK',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Kgv',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Basket',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Block',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Sticks',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Box',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Plt',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Tab',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Boxes',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Btl',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Gallon',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Tin',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Tap',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Jar',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Doz',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Sack',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Galon',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Bag',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
        ));
        
        
    }
}
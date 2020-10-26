<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('suppliers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Makro',
                'tel' => '02-067-8999',
                'email' => 'admin@siammakro.co.th',
                'address' => '1468 ถนนพัฒนาการ แขวงพัฒนาการ เขตสวนหลวง กรุงเทพฯ 10250',
                'created_at' => '2020-09-17 18:53:12',
                'updated_at' => '2020-09-17 18:53:12',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Tescolotus',
                'tel' => '074-431-525',
                'email' => 'admin@tescolotus.com',
                'address' => '157/4 หมู่ที่ 5 ต.บ้านนา , อ.จะนะ , สงขลา, 90130',
                'created_at' => '2020-09-17 18:53:12',
                'updated_at' => '2020-09-17 18:53:12',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'SONKHLA MAKET FRUIT',
                'tel' => '000-000-0004',
                'email' => 'songkla.market.fruit@supplier.com',
                'address' => 'SONKHLA MAKET FRUIT, Muang, Songkla',
                'created_at' => '2020-10-25 15:53:19',
                'updated_at' => '2020-10-26 09:28:31',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'SONKHLA MAKET VEGATABLE',
                'tel' => '000-000-0003',
                'email' => 'sea.food.market@supplier.com',
                'address' => 'SONKHLA MAKET VEGATABLE, Muang, Songkla',
                'created_at' => '2020-10-25 15:53:35',
                'updated_at' => '2020-10-26 09:27:44',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Other',
                'tel' => '000-000-0005',
                'email' => 'other@supplier.com',
                'address' => 'Any Marget, Muang, Songkla',
                'created_at' => '2020-10-25 15:53:57',
                'updated_at' => '2020-10-26 09:29:11',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'BEEF MAKET',
                'tel' => '000-000-0002',
                'email' => 'beef.market@supplier.com',
                'address' => 'BEEF MAKET, Muang, Songkla',
                'created_at' => '2020-10-25 15:54:13',
                'updated_at' => '2020-10-26 09:26:58',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'SEA FOOD MAKET',
                'tel' => '000-000-0001',
                'email' => 'sea-food-market@supplier.com',
                'address' => 'SEA FOOD MARKET, Muang, Songkla',
                'created_at' => '2020-10-25 15:54:28',
                'updated_at' => '2020-10-26 09:26:19',
            ),
        ));
    }
}

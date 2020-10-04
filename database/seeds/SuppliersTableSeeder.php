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
        ));
    }
}

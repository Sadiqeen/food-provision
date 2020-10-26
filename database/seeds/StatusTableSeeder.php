<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('statuses')->delete();

        DB::table('statuses')->insert([
                0 => [
                    'id' => 1,
                    'status_en' => 'Request from vessel',
                    'status_th' => 'คำสั่งซื้อจากเรือ',
                ],
                1 => [
                    'id' => 2,
                    'status_en' => 'Waiting for PO',
                    'status_th' => 'รอใบสั่งซื้อ',
                ],
                2 => [
                    'id' => 3,
                    'status_en' => 'Added by Administrator',
                    'status_th' => 'เพิ่มโดยผู้ดูแลระบบ',
                ],
                3 => [
                    'id' => 4,
                    'status_en' => 'Confirmed order',
                    'status_th' => 'ยืนยันคำสั่งซื้อ',
                ],
                4 => [
                    'id' => 5,
                    'status_en' => 'Order in process',
                    'status_th' => 'กำลังรวบรวมสินค้า',
                ],
                5 => [
                    'id' => 6,
                    'status_en' => 'Shipping',
                    'status_th' => 'กำลังจัดส่ง',
                ],
                6 => [
                    'id' => 7,
                    'status_en' => 'Delivery confirmed',
                    'status_th' => 'ยืนยันการจัดส่ง',
                ],
                7 => [
                    'id' => 8,
                    'status_en' => 'Order completed',
                    'status_th' => 'คำสั่งซื้อเสร็จสมบูรณ์',
                ],
                8 => [
                    'id' => 9,
                    'status_en' => 'Order canceled',
                    'status_th' => 'คำสั่งซื้อถูกยกเลิก',
                ],
                9 => [
                    'id' => 10,
                    'status_en' => 'Order canceled by customer',
                    'status_th' => 'คำสั่งซื้อถูกยกเลิกโดยลูกค้า',
                ],
                10 => [
                    'id' => 11,
                    'status_en' => 'Order canceled by vessel',
                    'status_th' => 'คำสั่งซื้อถูกยกเลิกโดยเรือ',
                ],
            ]);
    }
}

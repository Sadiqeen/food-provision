<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'company' => 'FN & D SERVICES AND AGENCY CO., LTD',
            'email' => 'operation@fndservice.com',
            'tel' => '+66 95 786 5864',
            'address' => '118/67 Moo1 Tha kam Sub-Distrct Hatyai District Songkhla province 90110',
        ]);
    }
}
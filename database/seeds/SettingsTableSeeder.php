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
            'image' => 'uploads/Px2dPUUjyV1BKzcXYkmJS9S3ZnU0Kb31l5Qt5MxL.png',
            'authorised_signature' => 'uploads/F4MFdfAQN1yRpF43aogTWuzWSW5KDMBOuyaX4nyU.png',
            'email' => 'operation@fndservice.com',
            'tel' => '+66 95 786 5864',
            'address' => '118/67 Moo1 Tha kam Sub-Distrct Hatyai District Songkhla province 90110',
        ]);
    }
}

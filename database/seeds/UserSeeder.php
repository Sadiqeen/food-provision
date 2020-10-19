<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'locale' => 'th',
            'position' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

//        factory(App\User::class, 10)->create();
    }
}

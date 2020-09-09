<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name_en' => $faker->company,
        'name_th' => 'ลูกค้า__' . $faker->company,
        'coordinator_en' => $faker->name,
        'coordinator_th' => 'ไทย__' . $faker->name,
        'tel' => $faker->unique()->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address_en' => $faker->address,
        'address_th' => 'ไทย_' . $faker->address,
        'note' => $faker->sentences($nb = 3, $asText = true),
    ];
});

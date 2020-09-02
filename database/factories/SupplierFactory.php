<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name_en' => $faker->company,
        'name_th' => 'ไทย_'.$faker->company,
        'tel' => $faker->tollFreePhoneNumber,
        'email' => $faker->freeEmail,
        'address_th' => 'ไทย_'.$faker->address,
        'address_en' => $faker->address,
    ];
});

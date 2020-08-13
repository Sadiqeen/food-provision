<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'tel' => $faker->tollFreePhoneNumber,
        'email' => $faker->freeEmail,
        'address' => $faker->address,
    ];
});

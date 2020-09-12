<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'coordinator' => $faker->name,
        'tel' => $faker->unique()->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'note' => $faker->sentences($nb = 3, $asText = true),
    ];
});

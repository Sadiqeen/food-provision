<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Brand::class, function (Faker $faker) {
    return [
        'name_en' => $faker->jobTitle,
        'name_th' => 'ไทย_'.$faker->jobTitle,
    ];
});

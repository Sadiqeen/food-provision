<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Unit::class, function (Faker $faker) {
    return [
        'name_en' => $faker->jobTitle,
        'name_th' => 'หน่วยสินค้า_'.$faker->jobTitle,
    ];
});

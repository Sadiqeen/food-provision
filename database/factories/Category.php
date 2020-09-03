<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name_en' => $faker->jobTitle,
        'name_th' => 'ประเภทสินค้า_'.$faker->jobTitle,
    ];
});

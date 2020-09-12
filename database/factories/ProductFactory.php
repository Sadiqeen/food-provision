<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name_en" => $faker->company,
        "name_th" => 'ไทย__' . $faker->company,
        "price" => $faker->randomNumber($nbDigits = NULL, $strict = false),

        "supplier_id" => factory(App\Supplier::class),
        "brand_id" => factory(App\Brand::class),
        "category_id" => factory(App\Category::class),
        "unit_id" => factory(App\Unit::class),
    ];
});

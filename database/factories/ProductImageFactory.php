<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'image' =>  $faker->imageurl(250, 250),
        'product_id' => $faker->numberbetween(1, 100)
    ];
});

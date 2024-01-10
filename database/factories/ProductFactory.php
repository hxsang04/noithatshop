<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'product_name' => $faker->word,
        'category_id' => function () {
            return factory(App\Category::class)->create()->category_id;
        },
        'product_qty' => rand(10,100),
        'product_view' => rand(10,100),
        'product_sold' => 0,
        'product_status' => 1,
        'product_slug' => Str::slug($faker->word),
        'product_desc' =>  $faker->paragraph,
        'product_price' => $faker->randomFloat(2, 0, 90000),
        'product_image' => $faker->imageUrl(263, 279),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});

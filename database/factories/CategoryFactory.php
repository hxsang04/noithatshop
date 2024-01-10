<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->word,
        'category_slug' => Str::slug($faker->word),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});

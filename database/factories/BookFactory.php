<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $categoryId = Category::inRandomOrder()->first()->id;
    return [
        'category_id' => $categoryId,
        'title' => $faker->text,
        'writer' => $faker->name,
        'publication_year' => $faker->year,
        'publisher' => $faker->company,
        'description' => $faker->paragraph,
        'price' => $faker->randomNumber(),
        'weight' => mt_rand() / mt_getrandmax(),
        'stock' => $faker->randomNumber(),
        'image'=> $faker->image('public/storage/image', 640, 480, null, false)
    ];
});

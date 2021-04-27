<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'invoice' => Str::random(),
        'customer_phone' => $faker->phoneNumber,
        'customer_address' => $faker->phoneNumber,
        'sub_total' => $faker->rand(100, 10000),
        'address' => $faker->address
    ];
});

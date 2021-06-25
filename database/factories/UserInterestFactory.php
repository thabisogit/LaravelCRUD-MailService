<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserInterest;
use Faker\Generator as Faker;

$factory->define(UserInterest::class, function (Faker $faker) {
    return [
        "interest" => $faker->word,
    ];
});

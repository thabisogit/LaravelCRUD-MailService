<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserLanguage;
use Faker\Generator as Faker;



$factory->define(UserLanguage::class, function (Faker $faker) {

    return [
        "language" => $faker->word,
    ];
});

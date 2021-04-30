<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unlike;
use Faker\Generator as Faker;

$factory->define(Unlike::class, function (Faker $faker) {
    return [
        //
        'user_id'=>$faker->numberBetween(1,50),
        'post_id'=>$faker->numberBetween(1,50),
    ];
});

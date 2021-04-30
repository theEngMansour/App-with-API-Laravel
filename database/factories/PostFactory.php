<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'user_id'=>$faker->numberBetween(1,50),
        'title'=>$faker->word,
        'body'=>$faker->paragraph,
        'excerpt'=>$faker->paragraph(1),
        'image_path'=>$faker->word,
    ];
});

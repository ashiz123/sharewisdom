<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        "image" => $faker->image('public/images',640,480, null, false),
        "publish" => $faker->boolean,
        'links' =>  'wwww.laravel.com',
        'author' => $faker->name
    ];
});




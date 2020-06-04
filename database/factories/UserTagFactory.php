<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserTag;
use Faker\Generator as Faker;

$factory->define(UserTag::class, function (Faker $faker) {
    return [
        'user_id' => 3,
        'tag_id' => 3
    ];
});

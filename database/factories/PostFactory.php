<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});

<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'body'      =>  $faker->realText(mt_rand(80, 400))
    ];
});

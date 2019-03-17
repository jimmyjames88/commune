<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [

        'body'      =>  $faker->realText(mt_rand(10, 60))
    ];
});

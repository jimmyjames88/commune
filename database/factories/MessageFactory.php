<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'body'  =>  $faker->realText(mt_rand(15, 100))
    ];
});

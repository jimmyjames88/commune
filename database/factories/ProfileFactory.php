<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    static $id = 1;
    return [
        'user_id'   =>  $id++,
        'location'  =>  'Calgary, AB',
        'birthday'  =>  $faker->dateTime(),
        'bio'       =>  $faker->realText(mt_rand(10, 40)),
        'avatar'    =>  $faker->text(mt_rand(5, 12)) . '.png',
        'website'   =>  $faker->url()
    ];
});

function autoIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

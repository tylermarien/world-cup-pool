<?php

use Faker\Generator as Faker;

$factory->define(App\SportsDb\Round::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});

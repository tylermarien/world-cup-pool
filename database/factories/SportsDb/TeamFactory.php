<?php

use Faker\Generator as Faker;

$factory->define(App\SportsDb\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

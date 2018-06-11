<?php

use Faker\Generator as Faker;

$factory->define(App\SportsDb\Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\SportsDb\Game::class, function (Faker $faker) {
    return [
        'score1' => $faker->numberBetween(0, 3),
        'score2' => $faker->numberBetween(0, 3),
    ];
});

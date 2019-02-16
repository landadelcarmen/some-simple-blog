<?php

use Faker\Generator as Faker;

$factory->define(\App\BlogCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence
    ];
});

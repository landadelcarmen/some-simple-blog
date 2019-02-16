<?php

use Faker\Generator as Faker;

$factory->define(\App\BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2)
    ];
});

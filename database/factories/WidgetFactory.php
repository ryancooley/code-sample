<?php

use Faker\Generator as Faker;

$factory->define(App\Widget::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'code' => $faker->randomNumber,
        'status' => $faker->randomElement(['active', 'inactive']),
    ];
});

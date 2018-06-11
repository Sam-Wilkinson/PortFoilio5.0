<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->sentence(rand(20,30)),
        'social' =>$faker->url()
    ];
});

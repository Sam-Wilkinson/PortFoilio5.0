<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->sentence(rand(20,30)),
        'image' =>'no-image-available.png',
        'social' =>$faker->url()
    ];
});

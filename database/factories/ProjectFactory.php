<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName(),
        'description' => $faker->sentence(rand(20,30)),
        'URL' =>$faker->url(),
        'date' =>$faker->date($format = 'Y-m-d', $max = 'now'),
        'image' => 'Block.jpeg'
    ];
});

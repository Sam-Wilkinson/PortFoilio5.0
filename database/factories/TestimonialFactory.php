<?php

use Faker\Generator as Faker;

$factory->define(App\Testimonial::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(rand(5,10)),
    ];
});

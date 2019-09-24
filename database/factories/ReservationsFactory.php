<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\reservations;

$factory->define(reservations::class, function (Faker $faker) {
    return [
        //
        'reservation_name' => $faker->name,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'start' => $faker->dateTimeBetween('now','+1 days 4 hours' ),
        'end' => $faker->dateTimeBetween('now', '+1 days 4 hours'),
    ];
});

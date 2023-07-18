<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Package;
use Faker\Generator as Faker;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'width' => $faker->randomFloat(2, 1, 100),
        'height' => $faker->randomFloat(2, 1, 100),
        'length' => $faker->randomFloat(2, 1, 100),
        'weight' => $faker->randomFloat(2, 1, 100),
        'receiver_id' => function() {
            return factory(\App\Models\Receiver::class)->create()->id;
        }
    ];
});

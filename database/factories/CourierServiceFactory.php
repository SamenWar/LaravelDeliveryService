<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourierService;
use Faker\Generator as Faker;

$factory->define(CourierService::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'api_url' => $faker->url,
    ];
});

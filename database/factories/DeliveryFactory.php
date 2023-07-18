<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Delivery;
use Faker\Generator as Faker;

$factory->define(Delivery::class, function (Faker $faker) {
    return [
        'package_id' => factory(\App\Models\Package::class),
        'courier_service_id' => factory(\App\Models\CourierService::class),
        'status' => $faker->randomElement(['Pending', 'In Progress', 'Delivered']),
        'sender_address' => $this->faker->address,
    ];
});

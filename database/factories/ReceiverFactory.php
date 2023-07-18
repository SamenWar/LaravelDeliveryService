<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Receiver;
use Faker\Generator as Faker;

$factory->define(Receiver::class, function (Faker $faker) {
    return [
        'full_name' => $this->faker->name,
        'phone_number' => $this->faker->phoneNumber,
        'email' => $this->faker->unique()->safeEmail,
        'address' => $this->faker->address,
    ];
});

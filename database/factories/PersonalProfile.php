<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PersonalProfile::class, function (Faker $faker) {

    $genders = ['Male','Female'];

    return [
        'second_name' => $faker->firstName,
        'second_last_name' => $faker->lastName,
        'gender' => $genders[array_rand($genders, 1)],
        'birthdate' => now()->subYears(rand(25,40)),
        'country' => $faker->country,
        'state' => $faker->state,
        'phone_number' => $faker->phoneNumber,
    ];
});

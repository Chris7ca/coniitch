<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmergencyContact::class, function (Faker $faker) {

    $relationships = ['Padre','Madre','Esposa','Esposa'];

    return [
        'relationship' => $relationships[array_rand($relationships, 1)],
        'full_name' => $faker->name,
        'first_phone_number' => $faker->e164PhoneNumber,
        'second_phone_number' => $faker->e164PhoneNumber
    ];
});

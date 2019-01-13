<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProfessionalProfile::class, function (Faker $faker) {
    return [
        'job_title' => $faker->jobTitle,
        'institute' => $faker->company,
        'country' => $faker->country,
        'state' => $faker->state,
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AcademicProfile::class, function (Faker $faker) {

    $careers = ['Lic. Psicología','Mtro. Psicología','Lic. Informática','Dr. Psicología','Lic. Administración'];
    $schools = ['Universidad Autónoma del Estado de Morelos', 'Universidad Nacional Autónoma de México','Universidad Autónoma de Guadalajara'];

    return [
        'career' => $careers[array_rand($careers, 1)],
        'institute' => $schools[array_rand($schools, 1)],
        'faculty' => 'XXXXXXXXXX',
        'country' => $faker->country,
        'state' => $faker->state
    ];
});

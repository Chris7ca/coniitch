<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Criteria::class, function (Faker $faker) {

    $axes = ['Research', 'Theoretical','BothOfThem'];

    return [
       'title' => $faker->sentence(6, true),
       'description' => $faker->text(200),
       'axis' => $axes[array_rand($axes, 1)] 
    ];
});

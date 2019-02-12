<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Work::class, function (Faker $faker) {

    $themes = ['Health and Society', 'Transdiscipline'];
    $axes   = ['Research','Theoretical'];
    $types  = ['Oral','Banner'];

    return [
        'title' => $faker->sentence(6 , true),
        'theme' => $themes[array_rand($themes, 1)],
        'axis'  => $axes[array_rand($axes, 1)],
        'type'  => $types[array_rand($types, 1)],
        'adscription' => $faker->sentence(6, true),
        'content' => $faker->paragraphs(5, true),
        'ready' => true,
        'version' => 1
    ];
});

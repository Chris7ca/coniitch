<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {

    $methods = ['Traditional','Facebook','Google'];

    return [
        'uuid' => (string) Str::uuid(),
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'has_personal_profile' => 1,
        'has_academic_profile' => 1,
        'has_emergency_contact' => 1,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'method_to_register' => $methods[array_rand($methods, 1)],
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

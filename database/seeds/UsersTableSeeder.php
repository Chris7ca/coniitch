<?php

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $faker = Faker::create();
        // $methods = ['Traditional','Facebook','Google'];

        $user = User::create([
            'uuid' => (string) Str::uuid(),
            'first_name' => 'Christian',
            'last_name' => 'Martínez',
            'email' => 'chris@mail.com',
            'email_verified_at' => now(),
            'has_personal_profile' => true,
            'has_academic_profile' => true,
            'has_emergency_contact' => true,
            'password' => Hash::make('secret'),
        ]);

        $user->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        $user->roles()->attach(1);

        // /** Seeds */

        // for ($i=0; $i < 3; $i++) { # usuarios no verificados
            
        //     $unverified_users = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'email' => $faker->unique()->safeEmail,
        //         'method_to_register' => 'Traditional',
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);

        //     $unverified_users->roles()->attach([6,10]);

        // }

        // for ($i=0; $i < 5; $i++) { # congresistas estudiantes

        //     $congressman = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'method_to_register' => $methods[array_rand($methods, 1)],
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);

        //     $congressman->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $congressman->academic_profile()->save(factory(App\Models\AcademicProfile::class)->make());
        //     $congressman->emergency_contact()->save(factory(App\Models\EmergencyContact::class)->make());
        //     $congressman->roles()->attach([6,8]);

        // }

        // for ($i=0; $i < 5; $i++) { # profesionistas

        //     $bussinesman = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'method_to_register' => $methods[array_rand($methods, 1)],
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);

        //     $bussinesman->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $bussinesman->academic_profile()->save(factory(App\Models\AcademicProfile::class)->make());
        //     $bussinesman->emergency_contact()->save(factory(App\Models\EmergencyContact::class)->make());
        //     $bussinesman->professional_profile()->save(factory(App\Models\ProfessionalProfile::class)->make());
        //     $bussinesman->work()->save(factory(App\Models\Work::class)->make());
        //     $bussinesman->roles()->attach([6,10]);
            
        // }

        // for ($i=0; $i < 15; $i++) { # revisores
            
        //     $revisors = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);
            
        //     $revisors->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $revisors->roles()->attach(3);

        // }

        // for ($i=0; $i < 2; $i++) { # administadores
            
        //     $admin = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);
            
        //     $admin->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $admin->roles()->attach(2);

        // }

        // for ($i=0; $i < 2; $i++) { # finanzas
            
        //     $finances = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);
            
        //     $finances->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $finances->roles()->attach(4);

        // }

        // for ($i=0; $i < 2; $i++) { # staff
            
        //     $helpers = User::create([
        //         'uuid' => (string) Str::uuid(),
        //         'first_name' => $faker->name,
        //         'last_name' => $faker->lastName,
        //         'has_personal_profile' => 1,
        //         'has_academic_profile' => 1,
        //         'has_emergency_contact' => 1,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     ]);
            
        //     $helpers->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        //     $helpers->roles()->attach(5);

        // }

        // $user = User::create([ 
        //     'uuid' => (string) Str::uuid(),
        //     'first_name' => 'Carlos',
        //     'last_name' => 'Carrillo',
        //     'email' => 'carlos@mail.com',
        //     'email_verified_at' => now(),
        //     'has_personal_profile' => true,
        //     'has_academic_profile' => true,
        //     'has_emergency_contact' => true,
        //     'password' => Hash::make('secret'),
        // ]);

        // $user->personal_profile()->save(factory(App\Models\PersonalProfile::class)->make());
        // $user->roles()->attach(9);

    }
}

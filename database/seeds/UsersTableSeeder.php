<?php

use App\Models\User;
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
        
        User::create([
            'first_name' => 'Christian',
            'last_name' => 'Martínez',
            'email' => 'chris@mail.com',
            'has_personal_profile' => true,
            'has_academic_profile' => true,
            'has_emergency_contact' => true,
            'password' => Hash::make('secret'),
        ]);

    }
}

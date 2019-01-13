<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = [
            [
                'key' => 'root', 'display_name' => 'Web Master', 'description' => 'lorem ipsum dolor is attem' // 1
            ],
            [
                'key' => 'admin', 'display_name' => 'Administrador', 'description' => 'lorem ipsum dolor is attem' // 2
            ],
            [
                'key' => 'revisor', 'display_name' => 'Revisor', 'description' => 'lorem ipsum dolor is attem' // 3
            ],
            [
                'key' => 'finances', 'display_name' => 'Finanzas', 'description' => 'lorem ipsum dolor is attem' // 4
            ],
            [
                'key' => 'staff', 'display_name' => 'Staff', 'description' => 'lorem ipsum dolor is attem' // 5 
            ],
            [
                'key' => 'congressman', 'display_name' => 'Congresista', 'description' => 'lorem ipsum dolor is attem' // 6
            ],
            [
                'key' => 'speaker', 'display_name' => 'Orador', 'description' => 'lorem ipsum dolor is attem' // 7
            ],
            [
                'key' => 'student', 'display_name' => 'Estudiante', 'description' => 'lorem ipsum dolor is attem' // 8
            ],

        ];

        Role::insert($roles);

    }
}

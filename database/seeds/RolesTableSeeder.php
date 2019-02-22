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
                'key' => 'admin', 'display_name' => 'Administradores', 'description' => 'lorem ipsum dolor is attem' // 2
            ],
            [
                'key' => 'revisor', 'display_name' => 'Revisores', 'description' => 'lorem ipsum dolor is attem' // 3
            ],
            [
                'key' => 'finances', 'display_name' => 'Finanzas', 'description' => 'lorem ipsum dolor is attem' // 4
            ],
            [
                'key' => 'staff', 'display_name' => 'Staff', 'description' => 'lorem ipsum dolor is attem' // 5 
            ],
            [
                'key' => 'congressman', 'display_name' => 'Congresistas', 'description' => 'lorem ipsum dolor is attem' // 6
            ],
            [
                'key' => 'speaker', 'display_name' => 'Oradores', 'description' => 'lorem ipsum dolor is attem' // 7
            ],
            [
                'key' => 'student', 'display_name' => 'Estudiantes', 'description' => 'lorem ipsum dolor is attem' // 8
            ],
            [
                'key' => 'public-relations', 'display_name' => 'Relaciones públicas', 'description' => 'lorem ipsum dolor is attem' // 9
            ],
            [
                'key' => 'professional', 'display_name' => 'Profesionistas', 'description' => 'lorem ipsum dolor is attem' // 10
            ],

        ];

        Role::insert($roles);

    }
}

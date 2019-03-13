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
                'key' => 'root', 'display_name' => 'Web Master', 'description' => 'Administrador de la aplicación' // 1
            ],
            [
                'key' => 'admin', 'display_name' => 'Administradores', 'description' => 'Gestores de los trabajos de congreso' // 2
            ],
            [
                'key' => 'revisor', 'display_name' => 'Revisores', 'description' => 'Evaluadores de los trabajos del congreso' // 3
            ],
            [
                'key' => 'finances', 'display_name' => 'Finanzas', 'description' => 'Gestores de la finanzas del congreso' // 4
            ],
            [
                'key' => 'staff', 'display_name' => 'Staff', 'description' => 'Becarios de apoyo a las coordinaciones del congreso' // 5 
            ],
            [
                'key' => 'congressman', 'display_name' => 'Congresistas', 'description' => 'Congresistas' // 6
            ],
            [
                'key' => 'speaker', 'display_name' => 'Ponentes', 'description' => 'Ponentes del congreso' // 7
            ],
            [
                'key' => 'student', 'display_name' => 'Estudiantes', 'description' => 'Estudiantes acreditados y asistentes al congreo' // 8
            ],
            [
                'key' => 'public-relations', 'display_name' => 'Relaciones públicas', 'description' => 'Gestores de relaciones públicas' // 9
            ],
            [
                'key' => 'professional', 'display_name' => 'Profesionistas', 'description' => 'Profesionistas asistentes al congreso' // 10
            ],

        ];

        Role::insert($roles);

    }
}

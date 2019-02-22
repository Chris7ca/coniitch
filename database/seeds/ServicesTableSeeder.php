<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $services = [
            [
                'name'      => 'Inscripción al congreso',
                'price'     => 1130,
                'details'   => 'Inscripción para estudiantes que han comprobado su estado académico.',
                'for_users' => [8],
                'discount'  => [
                    'name'      => 'Tarifa preferencial',
                    'discount'  => 200,
                    'details'   => 'Tarifa especial para pagos realizados antes del congreso',
                    'end_date'  => '2019-03-31 23:59:59'
                ]
            ],
            [
                'name'      => 'Inscripción al congreso',
                'price'     => 1630,
                'details'   => 'Inscripción para profesionistas',
                'for_users' => [10],
                'discount'  => [
                    'name'      => 'Tarifa preferencial',
                    'discount'  => 500,
                    'details'   => 'Tarifa especial para pagos realizados antes del congreso',
                    'end_date'  => '2019-03-31 23:59:59'
                ]
            ],
            [
                'name'      => 'Talleres',
                'price'     => 500,
                'details'   => 'Acceso a los talleres durante los tres días del congreso',
                'for_users' => [6],
                'discount'  => null
            ],
        ];
        
        foreach ( $services as $service ) {

            $s = Service::create([
                'concept' => $service['name'],
                'price'   => $service['price'],
                'details' => $service['details'],
            ]);

            $s->for_users()->attach($service['for_users']);
            
            if ( $service['discount'] ) {
                $s->discount()->create([
                    'name'      => $service['discount']['name'],
                    'discount'  => $service['discount']['discount'],
                    'details'   => $service['discount']['details'],
                    'end_date'  => $service['discount']['end_date']
                ]);
            }

        }

    }
}

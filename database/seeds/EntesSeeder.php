<?php

use Illuminate\Database\Seeder;

class EntesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\Ente::create([
        'id' => '1',
        'nombre' => 'Comisión Nacional del Servicio Civil',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '2',
        'nombre' => 'Congreso de la República',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '3',
        'nombre' => 'Contaduría General de la Nación',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '4',
        'nombre' => 'Contraloría General de la República',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '5',
        'nombre' => 'Contraloría General del departamento de Norte de Santander',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '6',
        'nombre' => 'Fiscalía General de la Nación',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '7',
        'nombre' => 'Ministerio de Salud y Protección Social',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '8',
        'nombre' => 'Procuraduría General de la Nación',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '9',
        'nombre' => 'Superintendencia Nacional de Salud',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

       App\Ente::create([
        'id' => '10',
        'nombre' => 'Supersalud',
        'fecha_creacion' => now(),
        'fecha_edicion' => now()
       ]);

    }
}

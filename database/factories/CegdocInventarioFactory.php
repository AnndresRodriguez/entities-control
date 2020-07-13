<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cegdoc\CegdocInventario::class, function (Faker $faker) {
    $dependencias = App\Models\Cegdoc\CegdocDependencia::pluck('id')->toArray();
    
    return [
        'codigo'                => $faker->numberBetween(1, 1000),
        'cegdoc_dependencia_id' => $faker->randomElement($dependencias),
        'numero_orden'          => $faker->numberBetween(1, 1000),
        'asunto'                => $faker->text,
        'fecha_inicial'         => $faker->date('Y-m-d'),
        'fecha_final'           => $faker->date('Y-m-d'),
        'unidad_conservacion'   => $faker->randomElement(['Expediente', 'Carpeta', 'Tomo', 'Otras']),
        'folios'                => $faker->numberBetween(1, 100),
        'soporte'               => $faker->randomElement(['PAPEL', 'OTRO']),
        'frecuencia_consulta'   => $faker->randomElement(['Alta', 'Mediana', 'Baja']),
        'notas'                 => $faker->text,
        'ubicacion'             => $faker->text(100),
        'observacion'           => $faker->text,
    ];
});

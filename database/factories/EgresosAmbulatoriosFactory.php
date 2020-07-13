<?php

use Faker\Generator as Faker;

$factory->define(App\EgresosAmbulatorio::class, function (Faker $faker) {
    return [
        'paciente_documento' => $faker->randomNumber(10),
        'paciente_tipo_documento' => 'CC',
        'paciente_nombres' => $faker->firstname,
        'paciente_apellidos' => $faker->lastname,
        'paciente_fecha_nacimiento' => $faker->date,
        'paciente_genero' => $faker->randomElement(['M', 'F']),
        'paciente_telefono' => $faker->randomNumber(10),

        'fecha_intervencion' => date('Y-m-d H:i:s'),
        'procedimiento_codigo' => $faker->randomNumber(6),
        'procedimiento_descripcion' => $faker->text(100),
        'cirujano' => $faker->name(),
    ];
});

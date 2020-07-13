<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cegdoc\CegdocDependencia::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
    ];
});

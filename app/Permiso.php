<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{

    /**
     * Los atributos que son asignables.
     *
     * @var array
     */
    protected $filliable = [
        'nombre', 'descripcion'
    ];

    /**
     * Metodo para acceder a la relacion del modelo permiso con el modelo role
     *
     * @return Object role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

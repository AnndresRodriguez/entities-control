<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'acciones';

    //protected $appends = ['nombre_usuario'];


    /**
     * Metodo para acceder a la relacion del modelo accion con el modelo user
     * 
     * @return Object user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Obtiene el nombre completo del empleado del usuario.
     * 
     * @return Array
     */
    public function getNombreUsuarioAttribute() {
        return $this->attributes['nombre_usuario'] = $this->user->empleado->nombreCompleto();
    }

}

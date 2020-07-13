<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'sesiones';


    /**
     * Metodo para acceder a la relacion del modelo Sesion con el modelo user
     * 
     * @return Object user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

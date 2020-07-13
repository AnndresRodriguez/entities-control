<?php

namespace App\Models\GestorPermisos;

use Illuminate\Database\Eloquent\Model;

class GesperSolicitudesRetiro extends Model
{
    protected $table = 'gesper_solicitudes_retiros';

    public function empleado() 
    {
    	return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function administrador() 
    {
    	return $this->belongsTo(\App\User::class, 'administrador_id');
    }

}

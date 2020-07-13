<?php

namespace App\Models\GestorPermisos;

use Illuminate\Database\Eloquent\Model;

class GesperModulo extends Model
{
    public function software()
    {
        return $this->belongsTo(GesperSoftware::class, 'gesper_software_id');
    }

    public function procesos()
    {
        return $this->hasMany(GesperProceso::class);
    }
}

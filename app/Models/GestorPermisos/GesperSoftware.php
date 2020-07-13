<?php

namespace App\Models\GestorPermisos;

use Illuminate\Database\Eloquent\Model;

class GesperSoftware extends Model
{
    public function modulos()
    {
        return $this->hasMany(GesperModulo::class);
    }
}

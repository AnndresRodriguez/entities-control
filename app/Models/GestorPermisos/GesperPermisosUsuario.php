<?php

namespace App\Models\GestorPermisos;

use Illuminate\Database\Eloquent\Model;

class GesperPermisosUsuario extends Model
{
    protected $fillable = [
        'user_id', 'gesper_proceso_id', 'ver', 'agregar', 'editar', 'imprimir', 'exportar', 'eliminar', 'fecha_vencimiento', 'estado'
    ];



    public function proceso()
    {
        return $this->belongsTo(GesperProceso::class, 'gesper_proceso_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}

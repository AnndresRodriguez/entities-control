<?php

namespace App\Models\GestorPermisos;

use Illuminate\Database\Eloquent\Model;

class GesperProceso extends Model
{
    protected $appends = ['ruta_permiso', 'ver', 'agregar', 'editar', 'imprimir', 'exportar', 'eliminar'];

    public function modulo()
    {
        return $this->belongsTo(GesperModulo::class, 'gesper_modulo_id');
    }

    public function getRutaPermisoAttribute()
    {
        $proceso = $this->load('modulo.software');

        return "{$proceso->modulo->software->nombre} >> {$proceso->modulo->nombre} >> {$proceso->nombre}";
    }

    public function getVerAttribute()
    {
        return false;
    }

    public function getAgregarAttribute()
    {
        return false;
    }

    public function getEditarAttribute()
    {
        return false;
    }

    public function getImprimirAttribute()
    {
        return false;
    }

    public function getExportarAttribute()
    {
        return false;
    }

    public function getEliminarAttribute()
    {
        return false;
    }
}

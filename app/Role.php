<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * Metodo para acceder a la relacion del modelo role con el modelo permiso
     * 
     * @return Object permiso
     */
    public function permisos(){
    	return $this->belongsToMany(Permiso::class);
    }
}

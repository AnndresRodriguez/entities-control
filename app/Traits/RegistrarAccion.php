<?php

namespace App\Traits;

use App\Models\Accion;

trait RegistrarAccion
{

    // 
    /**
     * Este metodo guarda las acciones de los usuarios
     * 
     * @param Object $datos
     * @return int 
     */
    public function storeAccion($datos)
    {
        $accion = new Accion();

        $accion->user_id     = $datos['user_id'];
        $accion->modulo      = $datos['modulo'];
        $accion->tabla       = $datos['tabla'];
        $accion->accion      = $datos['accion'];
        $accion->id_registro = $datos['id_registro'];
        $accion->observacion = $datos['observacion'];
        $accion->fecha       = date('Y-m-d');
        $accion->hora        = date("G:i:s A");
        $accion->save();


        if( $accion->id >= 1 ) {
            return $accion->id;
        }

        return 0;
    }

}
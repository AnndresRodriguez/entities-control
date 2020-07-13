<?php

namespace App\Traits;

use App\Models\Trazabilidad;

trait ExtensionReferencia
{


    /**
     * Este metodo guarda acciones de los usuarios
     * 
     * @param int $referencia_id
     * @param Object $cama
     * @return Array
     */
    public function StoreTrazabilidad($referencia_id, $cama)
    {
        $response = ['success' => 0, 'cama' => $cama];

        $referencia = Referencia::where('id', $referencia_id)->first();

        $response['cama_prev'] = $referencia->cama;

        $referencia->cama = $cama;
        $referencia->save();


        if( $referencia->wasChanged() ) {
            $response['success'] = 1;
        }

        return $response;
    }

    /**
     * Este metodo registra la fecha de una cita medica
     * 
     * @param int $referencia_id
     * @param date $fecha
     * @return int
     */
    public function registrarFechaCitaMedica($referencia_id, $fecha)
    {
        $referencia = Referencia::find($referencia_id)->get();

        $referencia->fecha_cita = $fecha;
        $referencia->save();

        return 1;
    }

}
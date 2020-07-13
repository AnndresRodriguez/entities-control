<?php

namespace App\Traits;

use App\Models\Referencia;

trait ReferenciaTrait
{

    /**
     * Este metodo actualiza en campo cama para una referencia determinada
     * 
     * @param int $referencia_id
     * @param Object $cama
     * @return Array
     */
    public function updateCamaReferencia($referencia_id, $cama)
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
     * Este metodo actualiza en campo fecha_cita para una referencia determinada
     * 
     * @param int $referencia_id
     * @param date $fecha
     * @return int
     * 
     */
    public function registrarFechaCitaMedicaReferencia($referencia_id, $fecha)
    {
        $referencia = Referencia::find($referencia_id)->get();

        $referencia->fecha_cita = $fecha;
        $referencia->save();

        return 1;
    }

}
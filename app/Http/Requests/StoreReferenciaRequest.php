<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'referencia.paciente_id'              => 'required',
            'referencia.pagador'                  => 'required',
            'referencia.regimen'                  => 'required',
            'referencia.folio'                    => 'required|min:1',
            'referencia.cie10_id'                 => 'required|min:1',
            'referencia.servicio_huem'            => 'required',
            'referencia.cama'                     => 'required',
            'referencia.tipo_referencia'          => 'required',
            'referencia.servicio_solicitado'      => 'required',
            'referencia.tipo_servicio_solicitado' => 'required',
            'referencia.tipo_traslado'            => 'required',
            'referencia.motivo_traslado'          => 'required',
            'referencia.fecha_solicitud'          => 'required'
        ];
    }
}

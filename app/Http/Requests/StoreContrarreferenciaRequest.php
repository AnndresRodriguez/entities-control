<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContrarreferenciaRequest extends FormRequest
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
            'paciente_id'      => 'required|min:1',
            'pagador_id'       => 'required|min:1',
            'regimen'          => 'required|min:1',
            'tipo_servicio'    => 'required|min:1',
            'ips_id'           => 'required|min:1',
            'tipo_paciente'    => 'required|min:1',
            'presentado'       => 'required|min:2|max:2',
            'departamento_id'  => 'required|min:1',
            'municipio_id'     => 'required|min:1',
            'diagnosticos'     => 'required|array|min:1',

            'aceptacion_negacion.codigo_aceptacion'       => 'required_if:aceptacion_negacion.aceptado_negado,ACEPTADO',
            'aceptacion_negacion.motivo_negacion'         => 'required_if:aceptacion_negacion.aceptado_negado,NEGADO',
            'aceptacion_negacion.profesional_responsable' => 'required_with:aceptacion_negacion.aceptado_negado',
        ];
    }
}

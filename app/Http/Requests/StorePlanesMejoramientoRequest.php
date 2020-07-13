<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanesMejoramientoRequest extends FormRequest
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
            'pdm_proceso_id'         => 'required|min:1',
            'estandar'               => 'required|min:1',
            'pdm_fuente_hallazgo_id' => 'required|min:1',
            'fecha_hallazgo'         => 'required|date',
            'descripcion_hallazgo'   => 'required|max:800',
            'tipo_accion'            => 'required',

            'accion_mejoramiento' => 'required|max:800',
            'prioridad_accion'    => 'required|min:1|max:4',

            'indicador_accion_mejora' => 'required|max:800',
            'meta_accion'             => 'required|max:800',
            'meta_impacto'            => 'required|max:800',

            'pdm_area_id'               => 'required|min:1',
            'responsable_accion'        => 'required|min:1|max:90',
            'fecha_formulacion'         => 'required|date',
            'fecha_maxima_cumplimiento' => 'required|date',
        ];
    }
}

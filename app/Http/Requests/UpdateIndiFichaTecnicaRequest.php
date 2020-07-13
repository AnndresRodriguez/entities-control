<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndiFichaTecnicaRequest extends FormRequest
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
            'ficha_tecnica.id'                  => 'required|exists:indi_ficha_tecnica,id',
            'ficha_tecnica.indicador_id'        => 'required|exists:indicadores,id',
            'ficha_tecnica.clasificacion'       => 'nullable|array|min:1',
            'ficha_tecnica.vigencia'            => 'required|min:1',
            'ficha_tecnica.justificacion'       => 'required|min:1',
            'ficha_tecnica.meta'                => 'required|min:1',
            'ficha_tecnica.periodicidad'        => 'required|min:1',
            'ficha_tecnica.fecha_limite'        => 'required|min:1',
            'ficha_tecnica.unidad_medida'       => 'required|min:1',
            'ficha_tecnica.muestreo_permitido'  => 'required|min:1',
            'ficha_tecnica.clasificacion'       => 'required|min:1',

            'numerador.descripcion'  => 'required|min:1',
            'numerador.fuente'       => 'required|min:1',

            'denominador.descripcion'  => 'required|min:1',
            'denominador.fuente'       => 'required|min:1',

            'calificacion.excelente_min' => 'required|min:1',
            'calificacion.excelente_max' => 'required|min:1',

            'calificacion.buena_min' => 'required|min:1',
            'calificacion.buena_max' => 'required|min:1',

            'calificacion.regular_min' => 'required|min:1',
            'calificacion.regular_max' => 'required|min:1',

            'calificacion.mala_min' => 'required|min:1',
            'calificacion.mala_max' => 'required|min:1',

            'responsables.user_id'               => 'required|min:1',
            'responsables.lider_jerarquico'      => 'required|min:5', 
            'responsables.correo_lider_proceso'  => 'required|email',
            'responsables.responsable_indicador' => 'required|min:5',
        ];
    }
}

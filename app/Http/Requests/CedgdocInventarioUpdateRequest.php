<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CedgdocInventarioUpdateRequest extends FormRequest
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
            'numero_orden' => 'required|numeric|min:1',
            'cegdoc_dependencia_id' => 'required|exists:cegdoc_dependencias,id',
            'asunto' => 'required|min:1',
            'fecha_inicial' => 'required|date',
            'fecha_final' => 'required|date',
            'unidad_conservacion' => 'required|min:1',
            'folios' => 'required|min:1',
            'soporte' => 'required|min:1',
            'frecuencia_consulta' => 'required|min:1',
            'estado' => 'required|min:1',
        ];
    }
}

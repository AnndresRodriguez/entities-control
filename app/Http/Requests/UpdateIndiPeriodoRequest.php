<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndiPeriodoRequest extends FormRequest
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
            'id'                    => 'required|exists:indi_periodos,id',
            'indi_ficha_tecnica_id' => 'required|exists:indi_ficha_tecnica,id',
            'mes'                   => 'required|min:1|:12',
            'numerador'             => 'required|numeric',
            'denominador'           => 'required|numeric',
            'resultado'             => 'required|numeric',
            'plan_mejoramiento'     => 'required',
            'analisis_resultado'    => 'required',
        ];
    }
}

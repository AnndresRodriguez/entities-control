<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiomCronogramaMantenimientoRequest extends FormRequest
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
            'biom_equipo_id' => 'required|min:1|exists:biom_equipos,id',
            'year' => 'required|regex:/(20[1-2][0-9])/',
        ];
    }
}

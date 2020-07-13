<?php

namespace App\Http\Requests;

use App\Rules\ValidarNombreColumnaBiomCM;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBiomCronogramaMantenimientoRequest extends FormRequest
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
            'cm_id'   => 'required|min:1|exists:biom_cronograma_mantenimientos,id',
            'columna' => ['required', new ValidarNombreColumnaBiomCM()],
            'estado'  => 'required|min:0|max:2',
        ];
    }
}

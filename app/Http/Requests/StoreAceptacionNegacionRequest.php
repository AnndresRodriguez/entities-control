<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAceptacionNegacionRequest extends FormRequest
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
            'cref_id'                 => 'required|min:1',
            'aceptado_negado'         => 'required|min:5',
            'profesional_responsable' => 'required|min:1',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrazabilidadRequest extends FormRequest
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
            'referencia_id' => 'required|integer|exists:referencias,id',
            'cama'          => 'sometimes|required:min:2',
            'soporte'       => 'required|mimes:pdf|max:2048',
            'trazabilidad'  => 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'referencia_id.requires' => 'El id de la referencia es obligatorio.',
            'referencia_id.integer'  => 'El id de la referencia no es un id valido.',
            'referencia_id.exists'   => 'El numero de referencia '. $this->request->get('referencia_id') .' no se encuentra registrado en la base de datos.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DocumentoValido;

class UpdatePacienteRequest extends FormRequest
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
            'id'             => 'required|min:1|exists:pacientes,id',
            'tipo_documento' => 'required|min:2',
            'documento'      => ['required', 'min:3', 'max:20', new DocumentoValido()],
            'nombres'        => 'required|min:3',
            'apellidos'      => 'required|min:4',
            'nacimiento'     => 'required|date',
            'genero'         => 'required',
        ];
    }
}

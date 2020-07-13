<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCirugiaRequest extends FormRequest
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
            'paciente_id'  => 'required',
            'pagador'      => 'required',
            'regimen'      => 'required',
            'cie10_id'     => 'required|min: 1',
            'tipo'         => 'required|max:20',
            'especialidad' => 'required|max:20',
            'cirujano'     => 'required|min:5|max:90',
            'fecha'        => 'required|date'
        ];
    }
}

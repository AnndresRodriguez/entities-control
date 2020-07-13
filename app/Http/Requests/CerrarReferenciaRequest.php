<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CerrarReferenciaRequest extends FormRequest
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
            'referencia_id'  => 'required|min:1',
            'ciudad'         => 'required|min:3',
            'fecha_traslado' => 'required|date',
            'ips_receptora'  => 'required',
            'ips_receptora'  => 'required|min:3',
        ];
    }
}

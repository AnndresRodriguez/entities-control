<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePdmSeguimientoRequest extends FormRequest
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
            'planes_mejoramiento_id' => 'required|min:1',
            'resultado_indicador'    => 'required|min:1',
            'estado_seguimiento'     => 'required|min:6',
            'soporte'                => 'sometimes|required|max:10240|mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,csv',
            'observacion'            => 'required|min:10',
        ];
    }

    public function messages() 
    {
        return [
            'soporte.max'   => 'El archivo supera el tamaño maximo permitido por el servidor (10MB).',
            'soporte.mimes' => 'Solo puede cargar archivos de tipo imagen, pdf, word o excel.',
            'uploaded'      => 'El archivo supera el tamaño maximo permitido por el servidor (10MB).'
        ];
    }
}

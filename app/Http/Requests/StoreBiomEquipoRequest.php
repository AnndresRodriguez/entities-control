<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiomEquipoRequest extends FormRequest
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
            'biom_nombres_equipo_id' => 'required|integer|exists:biom_nombres_equipos,id',

            'riesgo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
            'proveedor' => 'required',
            'responsable' => 'required',

            'biom_servicio_id' => 'required|integer|exists:biom_servicios,id',
            'biom_ambiente_id' => 'required|integer|exists:biom_ambientes,id',
        ];
    }

    public function messages()
    {
        return [
            'biom_servicio_id.requires' => 'El id del servicio es obligatorio.',
            'biom_servicio_id.integer'  => 'El id del servicio no es un numero entero valido.',
            'biom_servicio_id.exists'   => 'El servicio '. $this->request->get('biom_servicio_id') .' no se encuentra registrado en la base de datos.',

            'biom_ambiente_id.requires' => 'El id del ambiente es obligatorio.',
            'biom_ambiente_id.integer'  => 'El id del ambiente no es un numero entero valido.',
            'biom_ambiente_id.exists'   => 'El ambiente '. $this->request->get('biom_ambiente_id') .' no se encuentra registrado en la base de datos.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowIndiPeriodoRequest extends FormRequest
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
            'ficha_tecnica_id' => 'required|exists:indi_ficha_tecnica,id',
            'mes' => 'required|numeric|min:1|max:12',
        ];
    }
}

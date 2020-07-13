<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarNombreColumnaBiomCM implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
 
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if( \preg_match('/(s[1-9]|s[1-3][0-9]|s4[0-8])/', $value) ) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El nombre de la columna no corresponde a columna valida en la base de datos.';
    }
}

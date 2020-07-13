<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentoValido implements Rule
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
        $exp_regs = [
            '/^[0-9]{3,20}$/',
            '/^([A-z]{1,6})?[0-9]{2,20}$/',
            '/^(\d{3,6})(\w{1,3})(\d{3,6})?$/',
        ];

        foreach ($exp_regs as $exp_reg) {
            if( preg_match($exp_reg, $value) )
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
        return 'El campo :attribute no contiene un numero de documento valido.';
    }
}

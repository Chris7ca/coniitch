<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
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
        
        if ( strlen($value) < 8 ) {
            return false;
        } 

        else if ( ! preg_match('/[A-Z]+/', $value) ) {
            return false; 
        }

        else if ( ! preg_match('/[0-9]+/', $value) ) {
            return false; 
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La contraseña debe de tener mínimo 8 caracteres, una letra mayúscula, una letra minúscula y un dígito';
    }
}

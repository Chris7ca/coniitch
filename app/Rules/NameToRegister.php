<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NameToRegister implements Rule
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
        $length = explode(' ', $value);

        return sizeof($length) == 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo nombre debe contener el primer nombre y el primer apellido';
    }
}

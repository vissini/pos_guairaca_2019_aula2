<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class cpfRule implements Rule
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
        $numeros = preg_replace('/[^0-9]/', '', $value);

        if (strlen($numeros) == 11)
        {
            return true;
        }else{
            return false;
        }
    }

    public function message()
    {
        'cpf'
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

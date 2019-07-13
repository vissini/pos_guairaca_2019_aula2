<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;

class ProductRequest extends FormRequest
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
            'name' => ['required',
                        'min:3',
                        'max:100',
                        new Uppercase(),
        ],
            'number' => "required",
            'category' => 'required',
            'description' => 'min:3|max:500|nullable' 
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Campo obrigatório'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Service extends FormRequest
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
            'concept'   => 'required',
            'price'     => 'required|numeric',
            'details'   => 'required',
            'images'    => 'nullable',
            'images.*'  => 'mimes:png,jpg,jpeg',
            'for'       => 'required'
        ];
    }
}

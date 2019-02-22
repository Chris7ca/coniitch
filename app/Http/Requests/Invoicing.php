<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Invoicing extends FormRequest
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
            'type'          => 'required',
            'display_name'  => 'required',
            'rfc'           => 'required|size:13',
            'country'       => 'required',
            'zip_code'      => 'required|numeric',
            'state'         => 'required',
            'city'          => 'required',
            'address'       => 'required'
        ];
    }
}

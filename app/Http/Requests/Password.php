<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Password extends FormRequest
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
            'password' => 'required|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/|confirmed',
        ];
    }
}

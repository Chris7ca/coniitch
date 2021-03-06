<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Discount extends FormRequest
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
            'name'      => 'required',
            'discount'  => 'required|numeric',
            'details'   => 'required',
            'end_date'  => 'after_or_equal:today',
            'for'       => 'required'
        ];
    }
}

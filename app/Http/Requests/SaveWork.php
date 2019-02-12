<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWork extends FormRequest
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
            'title'                  => 'required_without_all:theme,type,axis,adscription,content',
            'theme'                  => 'required_without_all:title,type,axis,adscription,content',
            'type'                   => 'required_without_all:title,theme,axis,adscription,content',
            'axis'                   => 'required_without_all:title,theme,type,adscription,content',
            'adscription'            => 'required_without_all:title,theme,type,axis,content',
            'content'                => 'required_without_all:title,theme,type,axis,adscription',
            'authors'                => 'nullable',
            'authors.*.full_name'    => 'required',       
            'authors.*.email'        => 'required',       
            'authors.*.adcription'   => 'required',       
            'authors.*.first_author' => 'required'  
        ];
    }
}

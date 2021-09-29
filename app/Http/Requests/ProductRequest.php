<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Existe campo obrigatório a ser preenchido: Nome do Produto',
        ];
    }

}
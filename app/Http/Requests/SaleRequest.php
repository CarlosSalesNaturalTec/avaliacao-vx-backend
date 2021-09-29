<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules()
    {
        $rules = [
            'purchase_at' => 'required|date|before:tomorrow',
            'delivery_days' => 'required',
            'amount' => 'required',
            'products'=>'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'purchase_at.required' => 'Existe campo obrigatório a ser preenchido: Data da Venda',
            'purchase_at.date' => 'Data da Venda de venda inválida',
            'delivery_days.required' => 'Existe campo obrigatório a ser preenchido: Dias para Entrega',
            'amount.required' => 'Existe campo obrigatório a ser preenchido: Total da Venda',
            'products.required' => 'Existe campo obrigatório a ser preenchido: Produto',
        ];
    }

}
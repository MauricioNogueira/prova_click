<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFruitRequest extends FormRequest
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
            'nome' => 'required|unique:frutas',
            'quantidade' => 'required|integer',
            'data_validade' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'quantidade.required' => 'Quantidade é obrigatório',
            'data_validade.required' => 'Data de validade é obrigatório',
            'date' => 'Data inválida',
            'integer' => 'Somente números inteiros'
        ];
    }
}

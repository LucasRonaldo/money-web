<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'nome' => ' unique:produtos,nome|max:120|min:5',
        'categoria' => 'max:120|min:3',
        'preco' => 'numeric|min:0',
        'ingredientes' => 'max:500|min:10',
    ];
}


public function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'success' => false,
        'error' => $validator->errors()
    ]));
}


public function messages()
{
    return [
        'nome.max' => 'O nome do produto não pode exceder 120 caracteres.',
        'nome.min' => 'O nome do produto deve ter no mínimo 5 caracteres.',
        'categoria.max' => 'O nome da categoria não pode exceder 120 caracteres.',
        'categoria.min' => 'O nome da categoria deve ter no mínimo 3 caracteres.',
        'preco.numeric' => 'O preço deve ser um valor numérico.',
        'preco.min' => 'O preço não pode ser negativo.',
        'ingredientes.max' => 'A lista de ingredientes não pode exceder 500 caracteres.',
        'ingredientes.min' => 'A lista de ingredientes deve ter no mínimo 10 caracteres.',
    ];
}
}

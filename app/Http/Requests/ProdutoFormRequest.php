<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequest extends FormRequest
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
        'nome' => 'required|max:120|min:5',
        'categoria' => 'required|max:120|min:3',
        'preco' => 'required|numeric|min:0',
        'ingredientes' => 'required|max:500|min:10',
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
        'nome.required' => 'O nome do produto é obrigatório.',
        'nome.max' => 'O nome do produto não pode exceder 120 caracteres.',
        'nome.min' => 'O nome do produto deve ter no mínimo 5 caracteres.',
        'categoria.required' => 'A categoria do produto é obrigatória.',
        'categoria.max' => 'O nome da categoria não pode exceder 120 caracteres.',
        'categoria.min' => 'O nome da categoria deve ter no mínimo 3 caracteres.',
        'preco.required' => 'O preço do produto é obrigatório.',
        'preco.numeric' => 'O preço deve ser um valor numérico.',
        'preco.min' => 'O preço não pode ser negativo.',
        'ingredientes.required' => 'A lista de ingredientes é obrigatória.',
        'ingredientes.max' => 'A lista de ingredientes não pode exceder 500 caracteres.',
        'ingredientes.min' => 'A lista de ingredientes deve ter no mínimo 10 caracteres.',
    ];
}
}

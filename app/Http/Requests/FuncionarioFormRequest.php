<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FuncionarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'celular' => 'max:11|min:11',
            'email' => 'required|unique:cadastro_clientes,email|max:120'.$this->id,
            'cpf' => 'required|unique:cadastro_clientes,cpf|max:11|min:11'.$this->id,
            'data_nascimento' => 'required|date_format:d/m/Y',
            'cidade' => 'max:120|min:5',
            'estado' => 'max:2|min:2',
            'pais' => 'max:120',
            'rua' => 'max:11|min:11',
            'numero' => 'max:120',
            'bairro' => 'max:120|min:5',
            'cep' => 'max:11|min:11',
            'complemento' => 'required|max:120',
            'password' => 'required',

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
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode exceder 120 caracteres.',
            'nome.min' => 'O nome deve ter no mínimo 5 caracteres.',
            'celular.max' => 'O número de celular deve ter exatamente 11 dígitos.',
            'celular.min' => 'O número de celular deve ter exatamente 11 dígitos.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Esse email já está sendo usado.',
            'email.max' => 'O email não pode exceder 120 caracteres.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Esse CPF já está sendo usado.',
            'cpf.max' => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.min' => 'O CPF deve ter exatamente 11 dígitos.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date_format' => 'A data de nascimento deve estar no formato d/m/Y.',
            'cidade.max' => 'O nome da cidade não pode exceder 120 caracteres.',
            'cidade.min' => 'O nome da cidade deve ter no mínimo 5 caracteres.',
            'estado.max' => 'A sigla do estado deve ter exatamente 2 caracteres.',
            'estado.min' => 'A sigla do estado deve ter exatamente 2 caracteres.',
            'pais.max' => 'O nome do país não pode exceder 120 caracteres.',
            'rua.max' => 'O nome da rua não pode exceder 11 caracteres.',
            'rua.min' => 'O nome da rua deve ter no mínimo 11 caracteres.',
            'numero.max' => 'O número do endereço não pode exceder 120 caracteres.',
            'bairro.max' => 'O nome do bairro não pode exceder 120 caracteres.',
            'bairro.min' => 'O nome do bairro deve ter no mínimo 5 caracteres.',
            'cep.max' => 'O CEP deve ter exatamente 11 dígitos.',
            'cep.min' => 'O CEP deve ter exatamente 11 dígitos.',
            'complemento.required' => 'O complemento do endereço é obrigatório.',
            'complemento.max' => 'O complemento do endereço não pode exceder 120 caracteres.',
            'password.required' => 'A senha é obrigatória.'
        ];
    }
}

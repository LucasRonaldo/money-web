<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdiministradorFormRequest extends FormRequest
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
            'email' => 'required|unique:administradors,email|max:120'.$this->id,
            'cpf' => 'required|unique:administradors,cpf|max:11|min:11'.$this->id,
            
            'password' => 'required',
            'confirmar_password'=>'required_with:confirmar_password|same:password'

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
           'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Esse email já está sendo usado.',
            'email.max' => 'O email não pode exceder 120 caracteres.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Esse CPF já está sendo usado.',
            'cpf.max' => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.min' => 'O CPF deve ter exatamente 11 dígitos.',
            'password.required' => 'A senha é obrigatória.',
            'confirmar_password.required' => 'Digite a senha novamente',
            'confirmar_password.same' => 'Senhas não coincidem'
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdiministradorFormRequest;
use App\Http\Requests\AdiministradorFormRequestUpdate;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function cadastrarAdministrador(AdiministradorFormRequest $request)
    {
        
        if ($request->password !== $request->confirmar_password) {
            return response()->json([
                'status' => false,
                'message' => 'A senha deve ser igual',
            ], 400);
        }

        
        $administrador = Administrador::create([
            'nome' => $request->nome,   
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
        ]);

        if ($administrador) {
            return response()->json([
                'status' => true,
                'title' => 'Cadastrado',
                'message' => 'Administrador cadastrado com sucesso',
                'data' => $administrador
            ], 201);
        }

        return response()->json([
            'status' => false,
            'title' => 'Erro',
            'message' => 'Administrador não foi cadastrado',
        ], 500);
    }











    public function editarAdministrador(AdiministradorFormRequestUpdate $request)
    {
        $administrador = Administrador::find($request->id);
        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "administrador não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $administrador->nome = $request->nome;
        }

        if (isset($request->celular)) {
            $administrador->celular = $request->celular;
        }
        if (isset($request->email)) {
            $administrador->email = $request->email;
        }
        if (isset($request->cpf)) {
            $administrador->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $administrador->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $administrador->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $administrador->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $administrador->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $administrador->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $administrador->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $administrador->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $administrador->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $administrador->complemento = $request->complemento;
        }




        $administrador->update();

        return response()->json([
            'status' => true,
            'message' => 'administrador atualizado.'
        ]);
    }



    
    public function pesquisarPorIdAdiministrador($id)
    {
        $administrador = Administrador::find($id);

        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "administrador não cadastrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $administrador
        ]);
    }



    public function recuperarSenha(Request $request)
    {

        $administrador = Administrador::where('email', '=', $request->email)->first();

        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        $administrador = Administrador::where('cpf', '=', $request->cpf)->first();

        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "cpf nao encontrado"

            ]);
        }
        if (!isset($request->password)) {
            return response()->json([
                'status' => false,
                'message' => "Escreva a nova senha"

            ]);
        }
        if (isset($request->password)) {
            $administrador->password = $request->password; //Hash::make( $request->password );
        }
        $administrador->update();

        return response()->json([
            'status' => true,
            'password' => Hash::make($administrador->password)
        ]);
}}

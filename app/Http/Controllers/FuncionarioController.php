<?php

namespace App\Http\Controllers;
use App\Models\Funcionario;
use App\Http\Requests\FuncionarioFormRequest;

use App\Http\Requests\FuncionarioFormRequestUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
  
    public function cadastrarFuncionario(FuncionarioFormRequest $request)
    {

        

        $funcionario = Funcionario::create([

            

            'nome' => $request->nome,   
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password)


        ]);

        if(isset($funcionario)){

            return response()->json([
                'status' => true,
                'title'=>'Cadastrado',
                'message' => 'Funcionário Cadastrado com sucesso',
                'data' => $funcionario
    
            ], 200);
        }

        return response()->json([
            'status' => false,
            'title'=>'Erro',
            'message' => 'Funcionário não foi cadastrado',
            'data' => $funcionario

        ], 200);

        
    }




    public function editarFuncionario(FuncionarioFormRequestUpdate $request)
    {
        $funcionario = Funcionario::find($request->id);
        if (!isset($funcionario)) {
            return response()->json([
                'status' => false,
                'message' => "Funcionario não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $funcionario->nome = $request->nome;
        }

        if (isset($request->celular)) {
            $funcionario->celular = $request->celular;
        }
        if (isset($request->email)) {
            $funcionario->email = $request->email;
        }
        if (isset($request->cpf)) {
            $funcionario->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $funcionario->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $funcionario->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $funcionario->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $funcionario->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $funcionario->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $funcionario->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $funcionario->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $funcionario->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $funcionario->complemento = $request->complemento;
        }




        $funcionario->update();

        return response()->json([
            'status' => true,
            'message' => 'Funcionario atualizado.'
        ]);
    }






    public function pesquisarPorIdfuncionario($id)
    {
        $funcionario = Funcionario::find($id);

        if (!isset($funcionario)) {
            return response()->json([
                'status' => false,
                'message' => "funcionario não cadastrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $funcionario
        ]);
    }






    public function recuperarSenha(Request $request)
    {

        $funcionario = funcionario::where('email', '=', $request->email)->first();

        if (!isset($funcionario)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        $funcionario = funcionario::where('cpf', '=', $request->cpf)->first();

        if (!isset($funcionario)) {
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
            $funcionario->password = $request->password; //Hash::make( $request->password );
        }
        $funcionario->update();

        return response()->json([
            'status' => true,
            'password' => Hash::make($funcionario->password)
        ]);
}




public function retornarTodosFuncionarios()
{
    $funcionario = Funcionario::all();

    if (count($funcionario) > 0) {
        return response()->json([
            'status' => true,
            'data' => $funcionario
        ]);
    }
    return response()->json([
        'status' => false,
        'data' => 'Não há nenhum funcionario registrado'
    ]);
}



public function excluirfuncionario($id)
    {
        $funcionario = Funcionario::find($id);

        if (!isset($funcionario)) {
            return response()->json([
                'status' => false,
                'message' => "funcionario não encontrado"
            ]);
        }

        $funcionario->delete();
        return response()->json([
            'status' => true,
            'message' => "funcionario excluido com sucesso"
        ]);
    }


}

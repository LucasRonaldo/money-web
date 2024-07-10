<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function cadastrarCliente(ClienteFormRequest $request)
    {



        $cliente = Cliente::create([


            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
            'confirmar_password' => $request->confirmar_password


        ]);
       // dd($cliente->confirmar_password);

        if (isset($cliente)) {

            return response()->json([
                'status' => true,
                'title' => 'Cadastrado',
                'message' => 'Cliente Cadastrado com sucesso',
                'data' => $cliente

            ], 200);
        }

        return response()->json([
            'status' => false,
            'title' => 'Erro',
            'message' => 'Cliente não foi cadastrado',
            'data' => $cliente

        ], 200);
    }

    public function retornarTodosClientes()
    {
        $cliente = Cliente::all();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum cliente registrado'
        ]);
    }

    public function excluirCliente($id)
    {
        $cliente = Cliente::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluido com sucesso"
        ]);
    }

    public function editarCliente(ClienteUpdateFormRequest $request)
    {
        $cliente = Cliente::find($request->id);
        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }

        if (isset($request->celular)) {
            $cliente->celular = $request->celular;
        }
        if (isset($request->email)) {
            $cliente->email = $request->email;
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $cliente->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $cliente->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $cliente->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $cliente->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $cliente->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $cliente->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $cliente->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $cliente->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $cliente->complemento = $request->complemento;
        }




        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => 'Cliente atualizado.'
        ]);
    }

    public function pesquisarPorId($id)
    {
        $cliente = Cliente::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "cliente não cadastrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $cliente
        ]);
    }



    public function pesquisarClientePorNome(Request $request)
    {
        $cliente = Cliente::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum cliente foi encontrado'
        ]);
    }



    public function pesquisarClientePorCpf(Request $request)
    {
        $cliente = Cliente::where('cpf', '=',  $request->cpf)->first();

        if (isset($cliente)) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum CPF encontrado'
        ]);
    }

    public function pesquisarClientePorCelular(Request $request)
    {
        $cliente = Cliente::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum celular foi encontrado'
        ]);
    }

    public function pesquisarClientePorEmail(Request $request)
    {
        $cliente = Cliente::where('email', '=', $request->email)->first();

        if (isset($cliente)) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum email foi encontrado'
        ]);
    }

    public function recuperarSenha(Request $request)
    {

        $cliente = Cliente::where('email', '=', $request->email)->first();

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        $cliente = Cliente::where('cpf', '=', $request->cpf)->first();

        if (!isset($cliente)) {
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
            $cliente->password = $request->password; //Hash::make( $request->password );
        }
        $cliente->update();

        return response()->json([
            'status' => true,
            'password' => Hash::make($cliente->password)
        ]);
    }
}

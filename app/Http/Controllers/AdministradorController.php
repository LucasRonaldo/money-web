<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    // Cadastro de Produtos
    public function cadastroProdutos(ProdutoFormRequest $request)
    {
        $produto = Administrador::create([

            'nome' => $request->nome,
            'preco' => $request->preco,
            'ingredientes' => $request->ingredientes,
            'categoria' => $request->categoria,
        ]);
        return response()->json([
            "success" => true,
            "message" => "Cadastrado com sucesso",
            "data" => $produto
        ], 200);
    }






    public function cadastrarADM(Request $request)
    {



        $cliente = Cliente::create([


            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password)


        ]);

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







    public function updateProdutos(ProdutoFormRequest $request)
    {
        $produto = Administrador::find($request->id);
        if (!isset($produto)) {
            return response()->json([
                'status' => false,
                'message' => 'Produto não encontrado'
            ]);
        }
        if (isset($request->nome)) {
            $produto->nome = $request->nome;
        }
        if (isset($request->preco)) {
            $produto->preco = $request->preco;
        }
        if (isset($request->ingredientes)) {
            $produto->ingredientes = $request->ingredientes;
        }
        if (isset($request->categoria)) {
            $produto->categoria = $request->categoria;
        }

        $produto->update();
        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);
    }



    public function pesquisaProdutos($pesquisa)
    {

        $query = Administrador::query();

        $query->where(function ($q) use ($pesquisa) {
            $q->where('nome', 'like', '%' . $pesquisa . '%')
                ->orWhere('preco', 'like', '%' . $pesquisa . '%')
                ->orWhere('ingredientes', 'like', '%' . $pesquisa . '%')
                ->orWhere('categoria', 'like', '%' . $pesquisa . '%');
        });

        $produto = $query->get();
        if (count($produto) > 0) {
            return response()->json([
                'status' => true,
                'data' => $produto
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => "Nenhum resultado encontrado"
        ]);
    }
}

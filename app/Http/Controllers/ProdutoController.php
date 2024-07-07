<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Http\Requests\ProdutoFormRequestUpdate;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Cadastro de Produtos
    public function cadastroProdutos(ProdutoFormRequest $request)
    {
        $produto = Produto::create([

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









    public function updateProduto(ProdutoFormRequestUpdate $request)
    {
        $produto = Produto::find($request->id);
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

        $query = Produto::query();

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



    public function pesquisarPorIdProduto($id)
    {
        $produto = Produto::find($id);

        if (!isset($produto)) {
            return response()->json([
                'status' => false,
                'message' => "produto não cadastrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $produto
        ]);
    }




    public function retornarTodosProduto()
    {
        $produto = Produto::all();

        if (count($produto) > 0) {
            return response()->json([
                'status' => true,
                'data' => $produto
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum produto registrado'
        ]);
    }




    public function excluirproduto($id)
    {
        $produto = Produto::find($id);

        if (!isset($produto)) {
            return response()->json([
                'status' => false,
                'message' => "produto não encontrado"
            ]);
        }

        $produto->delete();
        return response()->json([
            'status' => true,
            'message' => "produto excluido com sucesso"
        ]);
    }


}

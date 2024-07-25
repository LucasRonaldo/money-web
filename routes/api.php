<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Controller;


// ------------------------------------ADIMINISTRADOR---------------------------

//-----------------------------------PERFIL:ADM------------------------------
route::post('adm/adiministrador/cadastro', [AdministradorController::class, 'cadastrarAdministrador']);
route::put('adm/adiministrador/editarCadastro', [AdministradorController::class, 'editarAdministrador']);
route::post('adm/adiministrador/pesquisaId', [AdministradorController::class, 'pesquisarPorIdAdiministrador']);
route::post('adm/adiministrador/recuperarSenha', [AdministradorController::class, 'recuperarSenha']);


//-----------------------------------PERFIL:PRODUTO------------------------------

route::post('adm/produto/cadastro', [ProdutoController::class, 'cadastroProdutos']);
route::put('adm/produto/editarCadastro', [ProdutoController::class, 'updateProduto']);
route::post('adm/produto/pesquisa', [ProdutoController::class, 'pesquisaProdutos']);
route::post('adm/produto/pesquisaId', [ProdutoController::class, 'pesquisarPorIdProduto']);
route::post('adm/produto/listagem', [ProdutoController::class, 'retornarTodosProduto']);
route::post('adm/produto/exclusao', [ProdutoController::class, 'excluirproduto']);


//-----------------------------------PERFIL:FUNCIONARIO------------------------------
route::post('adm/funcionario/cadastro', [FuncionarioController::class, 'cadastrarFuncionario']);
route::put('adm/funcionario/editarCadastro', [FuncionarioController::class, 'editarFuncionario']);
route::post('adm/funcionario/pesquisaId', [FuncionarioController::class, 'pesquisarPorIdfuncionario']);
route::post('adm/funcionario/pesquisaId', [FuncionarioController::class, 'pesquisarPorIdfuncionario']);
route::post('adm/funcionario/recuperarSenha', [FuncionarioController::class, 'recuperarSenha']);
route::get('adm/funcionario/listagem', [FuncionarioController::class, 'retornarTodosFuncionarios']);
route::delete('adm/funcionario/exclusao', [FuncionarioController::class, 'excluirfuncionario']);



// ------------------------------------FUNCIONARIO---------------------------


// ------------------------------------CLIENTE---------------------------
route::post('cliente/cadastro', [ClienteController::class, 'cadastrarCliente']);
route::delete('cliente/exclusao', [ClienteController::class, 'excluirCliente']);
route::put('cliente/editarCadastro', [ClienteController::class, 'editarCliente']);
route::put('cliente/recuperarSenha', [ClienteController::class, 'recuperarSenha']);

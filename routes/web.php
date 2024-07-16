<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Exercicio01Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',['name' => 'Samantha']);
});

Route::get('/view/Exercicio01',[Exercicio01Controller::class, 'Exercicio01View']);

Route::get('/Exercicio01',[Exercicio01Controller::class, 'Exercicio01'])->name('Exercicio01');


Route::get('/view/cadastrar/cliente',[ClienteController::class, 'cadastrarClienteView']);

Route::post('/cadastrar/cliente',[ClienteController::class, 'cadastrarCliente'])->name('CadastrarCliente');


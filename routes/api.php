<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;

// Cadastrar novo formulário
Route::post('formulario/store', [FormularioController::class, 'store']);

// Retornar todos os formulários
Route::get('formulario/all', [FormularioController::class, 'retornarTodos']);

// Excluir formulário por ID
Route::delete('formulario/{id}', [FormularioController::class, 'excluir']);

// Atualizar formulário (update)
Route::post('formulario/update', [FormularioController::class, 'editarCliente']);


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\Api\FormularioController as ApiFormularioController;

// Cadastrar novo formulário
Route::post('formulario/store', [FormularioController::class, 'store']);

// Retornar todos os formulários
Route::get('formulario/all', [FormularioController::class, 'retornarTodos']);

// Excluir formulário por ID
Route::delete('formulario/{id}', [FormularioController::class, 'excluir']);




Route::get('/formularios', [ApiFormularioController::class, 'index']);
Route::get('/formularios/{id}', [ApiFormularioController::class, 'show']);

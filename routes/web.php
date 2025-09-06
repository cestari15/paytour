<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularioController;

Route::get('/formulario', function () {
    return view('formulario');
})->name('formulario.view');

Route::post('/formulario', [FormularioController::class, 'store'])->name('formularios.store');


Route::get('/formulario/{id}/editar', [FormularioController::class, 'editarView'])->name('formularios.edit');
Route::put('/formulario/{id}', [FormularioController::class, 'update'])->name('formularios.update');

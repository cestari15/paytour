<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularioController;




Route::get('/', function () {
    return redirect()->route('formularios.create');
});

Route::get('/formulario', [FormularioController::class, 'create'])->name('formularios.create');
Route::post('/formulario', [FormularioController::class, 'store'])->name('formularios.store');




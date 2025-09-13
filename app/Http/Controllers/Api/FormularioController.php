<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        $formularios = Formulario::all();

        return response()->json([
            'status' => $formularios->count() > 0,
            'data' => $formularios->count() > 0 ? $formularios : 'Não há nenhum currículo registrado'
        ]);
    }

    public function show($id)
    {
        $formulario = Formulario::find($id);

        if (!$formulario) {
            return response()->json(['error' => 'Currículo não encontrado'], 404);
        }

        return response()->json($formulario);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioFormRequest;
use App\Http\Requests\FormularioUpdateFormRequest;
use App\Mail\FormularioCadastradoMail;
use App\Models\Formulario;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller
{
    // Exibir formulário de edição
    public function editarView($id)
    {
        $formulario = Formulario::find($id);

        if (!$formulario) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }

        return view('formulario_update', compact('formulario'));
    }

    // Cadastro

    public function store(FormularioFormRequest $request)
    {
        // Validação
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'required|min:5',
            'telefone' => 'required|min:11',
            'email' => 'required|email',
            'cargo_desejado' => 'required',
            'escolaridade' => 'required',
            'observacoes' => 'nullable',
            'arquivo' => 'required|file|max:1024', // 1MB
            'data_hora' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ]);
        }

        $dados = $request->only([
            'nome',
            'telefone',
            'email',
            'cargo_desejado',
            'escolaridade',
            'observacoes',
            'data_hora'
        ]);

        // Captura IP
        $dados['ip'] = $request->ip();

        // Upload do arquivo
        if ($request->hasFile('arquivo')) {
            $dados['arquivo'] = $request->file('arquivo')->store('arquivos', 'public');
        }

        // Salvar no banco
        $formulario = Formulario::create($dados);

        // Enviar email para o usuário cadastrado
        try {
            Mail::to($dados['email'])->send(new FormularioCadastradoMail($dados));
        } catch (\Exception $e) {
            // Log do erro sem quebrar a requisição
            \Log::error('Erro ao enviar email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Formulário cadastrado com sucesso!'
        ]);
    }



    // Atualizar
    public function update(FormularioUpdateFormRequest $request, $id)
    {
        $formulario = Formulario::find($id);
        if (!$formulario) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }

        // Atualizar arquivo se houver
        if ($request->hasFile('arquivo')) {
            $arquivo = $request->file('arquivo')->store('arquivos', 'public');
            $formulario->arquivo = $arquivo;
        }

        // Atualizar demais campos
        $formulario->nome = $request->nome;
        $formulario->telefone = $request->telefone;
        $formulario->email = $request->email;
        $formulario->cargo_desejado = $request->cargo_desejado;
        $formulario->escolaridade = $request->escolaridade;
        $formulario->observacoes = $request->observacoes;
        $formulario->data_hora = $request->data_hora;

        $formulario->save();

        return redirect()->back()->with('success', 'Currículo atualizado com sucesso!');
    }

    // Retornar todos os registros
    public function retornarTodos()
    {
        $formularios = Formulario::all();

        if ($formularios->count() > 0) {
            return response()->json([
                'status' => true,
                'data' => $formularios
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum Currículo registrado'
        ]);
    }

    // Excluir
    public function excluir($id)
    {
        $formulario = Formulario::find($id);

        if (!$formulario) {
            return redirect()->back()->with('error', 'Currículo não encontrado.');
        }

        $formulario->delete();

        return redirect()->back()->with('success', 'Currículo excluído com sucesso!');
    }
}

<?php

namespace Tests\Feature;

use App\Models\Formulario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormularioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function formulario_salva_no_banco_com_ip()
    {
        $formData = [
            'nome' => 'Rafael Cestari',
            'telefone' => '11999999999',
            'email' => 'teste@email.com',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade' => 'Superior',
            'observacoes' => 'Nenhuma',
            'arquivo' => UploadedFile::fake()->create('documento.pdf', 500),
            'data_hora' => now()->format('Y-m-d'),
        ];

        // Simula a requisição com IP específico
        $response = $this->withServerVariables(['REMOTE_ADDR' => '127.0.0.1'])
                         ->postJson(route('formularios.store'), $formData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('formularios', [
            'nome' => 'Rafael Cestari',
            'email' => 'teste@email.com',
            'ip' => '127.0.0.1', // verifica se o IP foi salvo
        ]);
    }

    /** @test */
    public function arquivo_invalido_nao_e_aceito()
    {
        $formData = [
            'nome' => 'Rafael Cestari',
            'telefone' => '11999999999',
            'email' => 'teste@email.com',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade' => 'Superior',
            'observacoes' => 'Teste',
            'arquivo' => UploadedFile::fake()->create('imagem.png', 500), // tipo inválido
            'data_hora' => now()->format('Y-m-d'),
        ];

        $response = $this->postJson(route('formularios.store'), $formData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('arquivo');
    }

    /** @test */
    public function arquivo_maior_que_1mb_nao_e_aceito()
    {
        $formData = [
            'nome' => 'Rafael Cestari',
            'telefone' => '11999999999',
            'email' => 'teste@email.com',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade' => 'Superior',
            'observacoes' => 'Teste',
            'arquivo' => UploadedFile::fake()->create('documento.pdf', 1500), // 1,5 MB
            'data_hora' => now()->format('Y-m-d'),
        ];

        $response = $this->postJson(route('formularios.store'), $formData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('arquivo');
    }

    /** @test */
    public function observacoes_e_opcional()
    {
        $formData = [
            'nome' => 'Rafael Cestari',
            'telefone' => '11999999999',
            'email' => 'teste@email.com',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade' => 'Superior',
            'observacoes' => null, // campo opcional
            'arquivo' => UploadedFile::fake()->create('documento.pdf', 500),
            'data_hora' => now()->format('Y-m-d'),
        ];

        $response = $this->postJson(route('formularios.store'), $formData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('formularios', [
            'nome' => 'Rafael Cestari',
            'observacoes' => null,
        ]);
    }

    /** @test */
    public function email_e_enviado_para_usuario()
    {
        Mail::fake();

        $formData = [
            'nome' => 'Rafael Cestari',
            'telefone' => '11999999999',
            'email' => 'teste@email.com',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade' => 'Superior',
            'observacoes' => 'Nenhuma',
            'arquivo' => UploadedFile::fake()->create('documento.pdf', 500),
            'data_hora' => now()->format('Y-m-d'),
        ];

        $this->postJson(route('formularios.store'), $formData);

        Mail::assertSent(\App\Mail\FormularioCadastradoMail::class, function ($mail) use ($formData) {
            return $mail->hasTo($formData['email']);
        });
    }
}

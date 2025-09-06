<?php

namespace App\Mail;

use App\Models\Formulario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormularioCadastradoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function build()
    {
        return $this->subject('Confirmação de Cadastro')
            ->view('emails.formulario_cadastrado')
            ->with('dados', $this->dados);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cargo_desejado',
        'escolaridade',
        'observacoes',
        'arquivo',
        'data_hora',
        'ip'
    ];
}

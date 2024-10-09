<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $table = 'professores';
    protected $fillable = ['nome', 'email', 'telefone'];

    public function rules(){
        $regras = [
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
        ];

        return $regras;
    }

    public function feedback(){
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute deve ser um e-mail válido',
        ];

        return $feedback;
    }
}

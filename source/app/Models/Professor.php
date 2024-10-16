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
            'foto' => 'required|file|mimes:jpeg,jpg,png'
        ];

        return $regras;
    }

    public function feedback(){
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute deve ser um e-mail válido',
            'foto.required' => 'É necessário enviar uma foto',
            'foto.mimes' => 'O arquivo enviado não é uma foto',
        ];

        return $feedback;
    }
}

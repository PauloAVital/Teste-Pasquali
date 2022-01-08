<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Salario;

class Colaborador extends Model
{
    protected $table = 'colaborador';
    
    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'rg',
        'nascimento',
        'cep',
        'endereco',
        'numero',
        'cidade',
        'estado'
    ];

    public function rules()
    {
        return [
            'cpf' => 'integer|required|unique:colaborador',
            'email' => 'required|unique:colaborador'
        ];
    }

    public function salario() {
        return $this->hasMany(Salario::class, 'id_colaborador', 'id' );
    }
}

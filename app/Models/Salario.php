<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Colaborador;

class Salario extends Model
{
    protected $table = 'salario';
    
    protected $fillable = [
        'id_colaborador',
        'salario'
    ];

    public function rules()
    {
        return [
            'id_colaborador' => 'integer|required|unique:colaborador',
            'salario' => 'required'
        ];
    }

    public function colaborador() {
        return $this->belongsTo(Colaborador::class, 'id_colaborador', 'id');
    }
}

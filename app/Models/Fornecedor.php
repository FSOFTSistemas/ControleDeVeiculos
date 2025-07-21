<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedors';

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'telefone',
        'email',
        'endereco',
        'empresa_id',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

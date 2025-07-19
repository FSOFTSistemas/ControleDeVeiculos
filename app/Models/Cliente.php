<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'telefone',
        'email',
        'endereco',
        'empresa_id',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

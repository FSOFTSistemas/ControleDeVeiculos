<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'veiculo_id',
        'fornecedor_id',
        'data_compra',
        'valor_total',
        'forma_pagamento',
        'observacoes',
        'empresa_id',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

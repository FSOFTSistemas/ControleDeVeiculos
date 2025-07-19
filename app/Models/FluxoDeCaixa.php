<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FluxoDeCaixa extends Model
{
    protected $table = 'fluxo_de_caixa';

    protected $fillable = [
        'data',
        'tipo', // entrada ou saida
        'descricao',
        'valor',
        'origem',
        'veiculo_id',
        'empresa_id',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

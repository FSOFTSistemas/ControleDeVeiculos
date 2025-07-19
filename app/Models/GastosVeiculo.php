<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastosVeiculo extends Model
{
    protected $table = 'gastos_veiculos';

    protected $fillable = [
        'veiculo_id',
        'tipo_gasto',
        'descricao',
        'valor',
        'data',
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

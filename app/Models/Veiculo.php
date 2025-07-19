<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';

    protected $fillable = [
        'marca',
        'modelo',
        'ano_fabricacao',
        'ano_modelo',
        'placa',
        'chassi',
        'renavam',
        'cor',
        'quilometragem',
        'tipo_combustivel',
        'valor_compra',
        'valor_venda',
        'data_compra',
        'data_venda',
        'status',
        'empresa_id',
    ];

    public function compra()
    {
        return $this->hasOne(Compra::class);
    }

    public function venda()
    {
        return $this->hasOne(Venda::class);
    }

    public function gastos()
    {
        return $this->hasMany(GastosVeiculo::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

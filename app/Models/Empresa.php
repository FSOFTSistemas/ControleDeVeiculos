<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
        'endereco',
    ];

    

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
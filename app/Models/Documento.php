<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'veiculo_id',
        'tipo_documento',
        'arquivo',
        'data_emissao',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}

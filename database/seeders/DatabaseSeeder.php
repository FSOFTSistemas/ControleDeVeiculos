<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empresa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $empresa = Empresa::create([
            'nome' => 'Empresa Padrão',
            'cnpj' => '00.000.000/0001-00',
            'email' => 'contato@empresapadrao.com',
            'telefone' => '(00) 0000-0000',
            'endereco' => 'Rua Exemplo, 123',
        ]);

        User::factory()->create([
            'name' => 'Master User',
            'email' => 'master@admin.com',
            'tipoUsuario' => 'master',
            'password' => Hash::make('master1234'),
            'empresa_id' => $empresa->id,
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fluxo_de_caixas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->string('descricao');
            $table->decimal('valor', 12, 2);
            $table->string('origem')->nullable();
            $table->foreignId('veiculo_id')->nullable()->constrained('veiculos')->onDelete('set null');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxo_de_caixas');
    }
};

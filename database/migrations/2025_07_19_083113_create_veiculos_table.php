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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->integer('ano_fabricacao');
            $table->integer('ano_modelo');
            $table->string('placa')->unique();
            $table->string('chassi')->unique();
            $table->string('renavam')->unique();
            $table->string('cor');
            $table->integer('quilometragem');
            $table->string('tipo_combustivel');
            $table->decimal('valor_compra', 12, 2)->nullable();
            $table->decimal('valor_venda', 12, 2)->nullable();
            $table->date('data_compra')->nullable();
            $table->date('data_venda')->nullable();
            $table->string('status')->default('disponivel');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};

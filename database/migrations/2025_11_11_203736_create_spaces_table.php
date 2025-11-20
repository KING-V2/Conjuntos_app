<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique(); // número de espacio
            $table->string('ubicacion')->nullable(); // opcional, ej: "Bloque A - Piso 1"
            $table->enum('tipo', ['carro', 'moto', 'bicicleta'])->default('carro');
            $table->enum('estado', ['disponible', 'ocupado', 'reservado'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};

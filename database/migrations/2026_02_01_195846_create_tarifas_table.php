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
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->enum('nombre', ['regular', 'nocturna', 'fin_de_semana', 'festivos']);
            $table->enum('tipo', ['por_hora', 'por_dia']);
            $table->decimal('costo', 10, 2);
            $table->integer('minutos_gavela');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas');
    }
};

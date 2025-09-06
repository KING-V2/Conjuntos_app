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
        Schema::create('informacion_conjuntos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conjunto_id');
            $table->foreign('conjunto_id')->references('id')->on('conjuntos');
            $table->json('dias'); // Almacena los días seleccionados en formato JSON
            $table->json('horas'); // Almacena las horas seleccionadas en formato JSON
            $table->string('telefonos', 255); // Almacena los teléfonos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_conjuntos');
    }
};

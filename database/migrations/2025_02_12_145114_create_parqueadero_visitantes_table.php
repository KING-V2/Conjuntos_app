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
        Schema::create('parqueadero_visitantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parqueadero_id');
            $table->foreign('parqueadero_id')->references('id')->on('parqueaderos');
            $table->string('placa');
            $table->datetime('hora_ingreso');
            $table->datetime('hora_salida')->nullable();
            $table->string('valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parqueadero_visitantes');
    }
};

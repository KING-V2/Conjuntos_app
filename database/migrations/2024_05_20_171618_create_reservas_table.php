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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->unsignedBigInteger('zona_comun_id');
            $table->foreign('zona_comun_id')->references('id')->on('zona_comun');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->longText('descripcion');
            $table->longText('descripcion_respuesta')->nullable();
            $table->string('estado');
            $table->unsignedBigInteger('administrador_id')->nullable();
            $table->foreign('administrador_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};

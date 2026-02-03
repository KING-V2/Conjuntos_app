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
        Schema::create('reservas_zonas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('identificacion');
            $table->unsignedBigInteger('conjunto_id');
            $table->foreign('conjunto_id')->references('id')->on('conjuntos');
            $table->unsignedBigInteger('zona_id');
            $table->foreign('zona_id')->references('id')->on('zona_comun');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->enum('estado', ['aprobada'])->default('aprobada');
            $table->string('asistencia');
            $table->string('mes');
            $table->date('fecha');
            $table->string('interior');
            $table->string('apartamento');
            $table->string('tipo_residente');
            $table->string('email');
            $table->string('celular');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_zonas');
    }
};

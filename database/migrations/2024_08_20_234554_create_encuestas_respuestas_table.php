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
        Schema::create('encuestas_respuestas', function (Blueprint $table) {
            $table->id();
            $table->string('respuesta')->nullable();
            $table->unsignedBigInteger('encuesta_id')->nullable();
            $table->foreign('encuesta_id')->references('id')->on('encuestas');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas_respuestas');
    }
};

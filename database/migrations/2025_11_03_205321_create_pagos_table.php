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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_pago');
            $table->unsignedBigInteger('casa_id');
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->text('descripcion')->nullable();
            $table->string('mes');
            $table->string('adjunto')->nullable();
            $table->string('adjunto_notificacion')->nullable();
            $table->text('comentario_admin')->nullable();
            $table->string('estado')->default('Pendiente');
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
        Schema::dropIfExists('pagos');
    }
};

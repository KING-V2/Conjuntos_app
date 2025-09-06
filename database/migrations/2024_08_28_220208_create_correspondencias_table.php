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
        Schema::create('correspondencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('casa_id');
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->integer('luz')->default('0');
            $table->integer('agua')->default('0');
            $table->integer('gas')->default('0');
            $table->integer('mensajes')->default('0');
            $table->integer('paquetes')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondencias');
    }
};

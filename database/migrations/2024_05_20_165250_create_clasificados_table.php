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
        Schema::create('clasificados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('casa_id');
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->string('estado');
            $table->string('foto');
            $table->string('adicional');
            $table->longText('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificados');
    }
};

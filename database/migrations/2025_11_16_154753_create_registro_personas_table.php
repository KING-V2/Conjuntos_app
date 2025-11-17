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
        Schema::create('registro_personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('documento', 100)->index();
            $table->string('mes', 50);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('casa_id');
            $table->timestamps();

            // Relaciones con otras tablas (si existen)
            $table->foreign('casa_id')
                ->references('id')
                ->on('casas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_personas');
    }
};

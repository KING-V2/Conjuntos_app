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
        Schema::create('zonas_horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zona_id')->constrained('zona_comun')->onDelete('cascade');
            $table->enum('tipo_dia', ['laboral','sabado','domingo','festivo']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('intervalo')->default(60);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zona_horarios');
    }
};

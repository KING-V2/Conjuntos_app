<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre o número del apartamento
            $table->string('number')->nullable(); // Número de apartamento
            $table->string('block')->nullable(); // Bloque
            $table->integer('floor')->nullable(); // Piso
            $table->string('address')->nullable(); // Dirección
            $table->string('phone')->nullable(); // Teléfono
            $table->string('email')->nullable(); // Email
            $table->text('notes')->nullable(); // Observaciones
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Propietario
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};

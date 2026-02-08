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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('espacio_id')->contrained('espacios');
            $table->foreignId('cliente_id')->contrained('clientes');
            $table->foreignId('vehiculo_id')->contrained('vehiculos');
            $table->foreignId('tarifa_id')->contrained('tarifas');
            $table->string('codigo_ticket', 20)->unique();
            $table->date('fecha_ingreso');
            $table->time('hora_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('tiempo_total')->nullable();
            $table->decimal('monto_total')->nullable();
            $table->enum('estado_ticket', ['activo', 'completado', 'cancelado']);
            $table->string('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

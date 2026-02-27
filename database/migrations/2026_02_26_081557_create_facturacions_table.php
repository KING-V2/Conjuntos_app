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
        Schema::create('facturacions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ticket_id')->constrained('tickets');
        $table->foreignId('cliente_id')->constrained('clientes');
        $table->string('numero_factura', 20)->unique();
        $table->string('nombres');
        $table->string('numero_documento'); // era time(), incorrecto
        $table->string('placa')->nullable(); // era date(), incorrecto
        $table->string('obs')->nullable();   // era time(), incorrecto
        $table->decimal('monto_total', 8, 2)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturacions');
    }
};

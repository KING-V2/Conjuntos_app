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
        Schema::table('zona_comun', function (Blueprint $table) {
            $table->unsignedBigInteger('conjunto_id')->nullable()->after('id');
            $table->text('descripcion')->nullable()->after('nombre');
            $table->boolean('activo')->default(true)->after('estado');
            $table->foreign('conjunto_id')->references('id')->on('conjuntos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zona_comun', function (Blueprint $table) {
            $table->dropForeign(['conjunto_id']);
            $table->dropColumn(['conjunto_id', 'descripcion', 'activo']);
        });
    }
};

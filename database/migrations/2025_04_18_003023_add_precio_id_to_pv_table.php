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
        Schema::table('parqueadero_visitantes', function (Blueprint $table) {
            $table->unsignedBigInteger('precio_id');
            $table->foreign('precio_id')->references('id')->on('categoria_vehiculo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parqueadero_visitantes', function (Blueprint $table) {
            $table->dropForeign(['precio_id']);
            $table->dropColumn('precio_id');
        });
    }
};

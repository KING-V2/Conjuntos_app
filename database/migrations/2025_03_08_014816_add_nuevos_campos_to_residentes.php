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
        Schema::table('residentes', function (Blueprint $table) {
            $table->unsignedBigInteger('parqueadero_id')->nullable();
            $table->foreign('parqueadero_id')->references('id')->on('parqueaderos');
            $table->string('no_carros')->default('0');
            $table->string('no_motos')->default('0');
            $table->string('no_mascotas')->default('0');
            $table->string('no_perros')->default('0');
            $table->string('no_gatos')->default('0');
            $table->string('no_adultos')->default('0');
            $table->string('no_ninos')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->dropColumn([
                'parqueadero_id',
                'no_carros',
                'no_motos',
                'no_mascotas',
                'no_perros',
                'no_gatos',
                'no_adultos',
                'no_ninos'
            ]);
        });
    }
};

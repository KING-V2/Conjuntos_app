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
            $table->dropForeign(['parqueadero_id']);
            $table->dropColumn('parqueadero_id');
            $table->dropColumn([
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

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

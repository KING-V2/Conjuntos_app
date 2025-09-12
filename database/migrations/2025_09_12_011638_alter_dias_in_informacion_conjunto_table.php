<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('informacion_conjuntos', function (Blueprint $table) {
            $table->text('dias')->nullable()->change(); 
        });
    }

    public function down(): void {
        Schema::table('informacion_conjuntos', function (Blueprint $table) {
            $table->json('dias')->nullable()->change();
        });
    }
};

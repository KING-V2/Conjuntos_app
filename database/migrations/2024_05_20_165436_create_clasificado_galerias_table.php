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
        Schema::create('clasificado_galerias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clasificado_id');
            $table->foreign('clasificado_id')->references('id')->on('clasificados');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificado_galerias');
    }
};

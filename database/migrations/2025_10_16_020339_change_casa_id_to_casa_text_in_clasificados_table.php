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
        Schema::table('clasificados', function (Blueprint $table) {
            $table->dropForeign(['casa_id']);
            $table->dropColumn('casa_id');
            $table->dropColumn('adicional');
            $table->string('casa')->after('whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clasificados', function (Blueprint $table) {
        });
    }
};

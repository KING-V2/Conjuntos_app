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
        Schema::table('casas', function (Blueprint $table) {
            $table->string('telefono_uno')->nullable();
            $table->string('telefono_dos')->nullable();
            $table->string('telefono_tres')->nullable();
            $table->string('telefono_cuatro')->nullable();
            $table->string('telefono_cinco')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('casas', function (Blueprint $table) {
            $table->dropColumn([
                'telefono_uno',
                'telefono_dos',
                'telefono_tres',
                'telefono_cuatro',
                'telefono_cinco',
            ]);
        });
    }
};

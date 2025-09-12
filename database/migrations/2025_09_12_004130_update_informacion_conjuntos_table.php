<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('informacion_conjuntos', function (Blueprint $table) {
            // eliminamos el campo antiguo si ya no se va a usar
            $table->dropColumn('horas');

            // agregamos los nuevos
            $table->text('texto_horas')->nullable();
            $table->text('texto_adicional')->nullable();
        });
    }

    public function down()
    {
        Schema::table('informacion_conjuntos', function (Blueprint $table) {
            // revertimos los cambios
            $table->json('horas')->nullable();
            $table->dropColumn(['texto_horas', 'texto_adicional']);
        });
    }

};

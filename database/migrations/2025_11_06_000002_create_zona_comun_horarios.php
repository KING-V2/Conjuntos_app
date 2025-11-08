<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonaComunHorarios extends Migration
{
    public function up()
    {
        Schema::create('zona_comun_horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zona_comun_id');
            $table->tinyInteger('dia_semana'); // 0 domingo .. 6 sabado
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();

            $table->foreign('zona_comun_id')->references('id')->on('zona_comun')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('zona_comun_horarios');
    }
}

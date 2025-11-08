<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComprobanteAndAdminToReservas extends Migration
{
    public function up()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->string('comprobante_pago')->nullable()->after('descripcion');
        });
    }

    public function down()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['comprobante_pago']);
        });
    }
}

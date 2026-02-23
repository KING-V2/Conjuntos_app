<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Apartamento;
use App\Models\Administracion\Casas;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'espacio_id',
        'cliente_id',
        'vehiculo_id',
        'tarifa_id',
        'apartamento_id',
        'casas_id',
        'codigo_ticket',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
        'tiempo_total',
        'monto_total',
        'estado_string',
        'obs',
    ];

    public function espacio(){
        return $this->belongsTo(Espacio::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
    public function tarifa(){
        return $this->belongsTo(Tarifas::class,'tarifa_id');
    }
    public function apartamento(){
        return $this->belongsTo(Apartamento::class);
    }
    public function casa(){
        return $this->belongsTo(Casas::class,'casas_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

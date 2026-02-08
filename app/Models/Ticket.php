<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'espacio_id',
        'cliente_id',
        'vehiculo_id',
        'tarifa_id',
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
    public function tarifas(){
        return $this->belongsTo(Tarifas::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

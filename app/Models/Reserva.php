<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas_zonas';

    protected $fillable = [
        'nombre_completo',
        'identificacion',
        'interior',
        'apartamento',
        'email',
        'celular',
        'conjunto_id',
        'zona_id',
        'fecha',
        'inicio',
        'telefono',
        'tipo_residente',
        'fin',
        'estado',
        'asistencia',
        'mes'
    ];

    public function conjunto()
    {
        return $this->belongsTo(Conjunto::class);
    }

    public function zona()
    {
        return $this->belongsTo(ZonaComun::class);
    }
}

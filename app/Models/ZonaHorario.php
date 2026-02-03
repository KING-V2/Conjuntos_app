<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaHorario extends Model
{
    protected $table = 'zonas_horarios';

    protected $fillable = [
        'zona_id',
        'tipo_dia',
        'hora_inicio',
        'hora_fin',
        'intervalo'
    ];

    public function zona()
    {
        return $this->belongsTo(ZonaComun::class, 'zona_id');
    }
}

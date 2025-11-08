<?php

namespace App\Models\Reservas;
use Illuminate\Database\Eloquent\Model;

class ZonaComunHorario extends Model
{
    protected $table = 'zona_comun_horarios';

    protected $fillable = [
        'zona_comun_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin'
    ];

    public function zona()
    {
        return $this->belongsTo(ZonaComun::class, 'zona_comun_id');
    }
}

<?php

namespace App\Models\Reservas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reservas\ZonaComun;

class Reserva extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'zona_comun_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'descripcion',
        'estado',
        'descripcion_respuesta',
        'administrador_id'
    ];

    public function zona_comun()
    {
        return $this->belongsTo(ZonaComun::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function administrador()
    {
        return $this->belongsTo(User::class);
    }
}

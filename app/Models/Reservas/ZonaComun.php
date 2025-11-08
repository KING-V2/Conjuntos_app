<?php

namespace App\Models\Reservas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaComun extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zona_comun';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'estado',
        'descripcion',
        'conjunto_id',
        'activo'
    ];
    public function conjunto()
    {
        return $this->belongsTo(Conjunto::class);
    }

    public function horarios()
    {
        return $this->hasMany(ZonaComunHorario::class, 'zona_comun_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'zona_comun_id');
    }
}

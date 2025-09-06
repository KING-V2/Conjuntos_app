<?php

namespace App\Models\Parqueaderos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Parqueadero;
use App\Models\Parqueaderos\CategoriaVehiculo;
use App\Models\Parqueaderos\PrecioParqueadero;

class ParqueaderoVisitantes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parqueadero_visitantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parqueadero_id',
        'categoria_id',
        'precio_id',
        'placa',
        'hora_ingreso',
        'hora_salida',
        'valor',
    ];

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaVehiculo::class);
    }

    public function precio()
    {
        return $this->belongsTo(CategoriaVehiculo::class);
    }
}

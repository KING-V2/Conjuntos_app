<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroParqueadero extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'parqueadero_id',
        'casa_id'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'parqueadero_id');
    }
    public function casas()
    {
        return $this->belongsTo(Administracion\Casas::class, 'casa_id');
    }
}

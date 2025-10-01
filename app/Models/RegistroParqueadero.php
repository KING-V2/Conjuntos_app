<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroParqueadero extends Model
{
    use HasFactory;

    protected $fillable = [
        'residente_id',
        'vehiculo_id',
        'parqueadero_id'
    ];

    public function residente()
    {
        return $this->belongsTo(Administracion\Residente::class, 'residente_id');
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'parqueadero_id');
    }
}

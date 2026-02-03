<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'cliente_id',
        'placa',
        'marca',
        'tipo'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}

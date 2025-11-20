<?php

namespace App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vehicle_id',
        'space_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    // Relación con cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con vehículo
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relación con espacio
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}

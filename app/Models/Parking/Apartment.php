<?php

namespace App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'block',
        'floor',
        'address',
        'phone',
        'email',
        'notes',
        'client_id',
    ];

    /**
     * Relación con Cliente (propietario del apartamento)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación con Vehículos asociados a este apartamento
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}

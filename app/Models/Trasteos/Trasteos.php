<?php

namespace App\Models\Trasteos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Ensure to import the User model

class Trasteos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trasteos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'administrador_id',
        'fecha',
        'hora',
        'estado',
        'mes',
        'descripcion',
        'descripcion_respuesta'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function administrador()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'casas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'conjunto_id',
        'telefono_uno',
        'telefono_dos',
        'telefono_tres',
        'telefono_cuatro',
        'telefono_cinco',
    ];

    public function conjunto()
    {
        return $this->belongsTo(Conjunto::class, 'conjunto_id');
    }
}

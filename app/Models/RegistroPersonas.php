<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Apartamento;

class RegistroPersonas extends Model
{
    use HasFactory;

    protected $table = 'registro_personas';

    protected $fillable = [
        'nombre',
        'documento',
        'mes',
        'foto',
        'casa_id'
    ];

    public function casas()
    {
        return $this->belongsTo(Casas::class, 'casa_id');
    }
}

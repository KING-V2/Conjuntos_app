<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Parqueadero;

class Residente extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'residentes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conjunto_id',
        'casa_id',
        'usuario_id',
        'estado',
        'tipo_residente',
        'parqueadero_id',
        'no_carros',
        'no_motos',
        'no_mascotas',
        'no_perros',
        'no_gatos',
        'no_adultos',
        'no_ninos'
    ];

    public function conjunto()
    {
        return $this->belongsTo(Conjunto::class, 'conjunto_id');
    }

    public function casas()
    {
        return $this->belongsTo(Casas::class, 'casa_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'parqueadero_id');
    }
    
}

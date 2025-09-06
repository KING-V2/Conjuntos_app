<?php

namespace App\Models\Correspondencia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Apartamento;
use App\Models\Administracion\Bloque;

class Correspondencia extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'correspondencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'casa_id',
        'luz',
        'agua',
        'gas',
        'mensajes',
        'paquetes'
    ];

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }
    
    public function bloque()
    {
        return $this->belongsTo(Bloque::class);
    }
}

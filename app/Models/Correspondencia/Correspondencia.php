<?php

namespace App\Models\Correspondencia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Casas;

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

    public function casa()
    {
        return $this->belongsTo(Casas::class);
    }
}

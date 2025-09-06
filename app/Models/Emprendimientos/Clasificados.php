<?php

namespace App\Models\Emprendimientos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Apartamento;

class Clasificados extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clasificados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'apartamento_id',
        'descripcion',
        'foto',
        'estado',
        'adicional'
    ];

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }
}

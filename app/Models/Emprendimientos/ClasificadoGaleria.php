<?php

namespace App\Models\Emprendimientos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emprendimientos\Clasificados;

class ClasificadoGaleria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clasificado_galerias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clasificado_id',
        'imagen'
    ];

    public function clasificado()
    {
        return $this->belongsTo(Clasificados::class);
    }
}

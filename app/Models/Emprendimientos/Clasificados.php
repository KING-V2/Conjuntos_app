<?php

namespace App\Models\Emprendimientos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Casas;

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
        'casa',
        'descripcion',
        'foto',
        'estado',
        'whatsapp'
    ];

    public function casa()
    {
        return $this->belongsTo(Casas::class);
    }
}

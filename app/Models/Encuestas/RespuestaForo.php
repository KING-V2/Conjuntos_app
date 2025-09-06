<?php

namespace App\Models\Encuestas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Encuestas\Foro;

class RespuestaForo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'respuesta_foros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'foro_id',
        'descripcion',
        'descripcion_admin',
        'mes'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function foro()
    {
        return $this->belongsTo(Foro::class);
    }
}

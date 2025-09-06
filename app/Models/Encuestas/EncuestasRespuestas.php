<?php

namespace App\Models\Encuestas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Encuestas\Encuestas;

class EncuestasRespuestas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'encuestas_respuestas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'respuesta',
        'encuesta_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuestas::class);
    }
}

<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogSistema extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_sistemas';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'accion',
        'datos',
        'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}

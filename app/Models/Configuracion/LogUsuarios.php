<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUsuarios extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_usuarios';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'usuario',
        'fecha'
    ];
}

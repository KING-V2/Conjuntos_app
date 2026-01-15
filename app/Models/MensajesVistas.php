<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajesVistas extends Model
{
    use HasFactory;

    protected $table = 'mensajes_vistas';

    protected $fillable = [
        'vista',
        'mensaje'
    ];
}

<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionConjunto extends Model
{
    use HasFactory;

    protected $table = 'informacion_conjuntos';

    protected $fillable = [
        'conjunto_id',
        'dias',
        'texto_horas',
        'texto_adicional'
    ];

    protected $casts = [
        'dias' => 'array'
    ];
}

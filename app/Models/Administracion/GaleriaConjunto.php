<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaConjunto extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galeria_conjuntos';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'imagen',
        'descripcion'
    ];
}

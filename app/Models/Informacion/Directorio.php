<?php

namespace App\Models\Informacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'directorios';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'nombre',
        'telefono'
    ];
}

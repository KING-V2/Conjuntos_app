<?php

namespace App\Models\Informacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'manuales';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'archivo'
    ];
}

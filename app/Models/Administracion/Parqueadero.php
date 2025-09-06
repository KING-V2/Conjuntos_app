<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Administracion\Residente;

class Parqueadero extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parqueaderos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'nombre',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function residente()
    {
        return $this->hasOne(Residente::class, 'usuario_id', 'usuario_id');
    }
}

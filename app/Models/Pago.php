<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Casas;
use App\Models\User;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_pago',
        'casa_id',//
        'descripcion',
        'mes',
        'adjunto',
        'adjunto_notificacion',
        'comentario_admin',
        'estado',
        'administrador_id',
    ];

    public function administrador()
    {
        return $this->belongsTo(User::class, 'administrador_id');
    }

    public function casas()
    {
        return $this->belongsTo(Casa::class, 'casa_id');
    }

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class, 'apartamento_id');
    }
    
}
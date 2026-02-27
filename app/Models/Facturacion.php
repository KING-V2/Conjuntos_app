<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;
    protected $table = 'facturacions';

protected $fillable = [
    'ticket_id',
    'cliente_id',
    'numero_factura',
    'nombres',
    'numero_documento',
    'placa',
    'obs',
    'monto_total',
];

public function ticket(){
    return $this->belongsTo(Ticket::class);
}

public function cliente(){
    return $this->belongsTo(Cliente::class);
}
}

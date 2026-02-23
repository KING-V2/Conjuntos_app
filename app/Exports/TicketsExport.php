<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsExport implements FromQuery, WithHeadings, WithMapping
{
    
    protected $mes;
    protected $anio;

    
    public function __construct($mes = null, $anio = null)
    {
        $this->mes  = $mes;
        $this->anio = $anio;
    }

    public function query()
    {
        return Ticket::query()
            ->with(['cliente', 'vehiculo', 'casa', 'apartamento'])
            
            ->when($this->mes,  fn($q) => $q->whereMonth('fecha_ingreso', $this->mes))
            ->when($this->anio, fn($q) => $q->whereYear('fecha_ingreso',  $this->anio));
    }
    

    public function headings(): array
    {
        return [
            'ID Ticket',
            'Cliente',
            'Placa',
            'Inmueble',
            'Fecha Ingreso',
            'Hora Ingreso',
            'Estado',
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->codigo_ticket,
            $ticket->cliente->nombres,
            $ticket->vehiculo->placa ?? 'N/A',
            $ticket->casa ? 'Casa: '.$ticket->casa->nombre : ($ticket->apartamento ? 'Apto: '.$ticket->apartamento->nombre : 'N/A'),
            $ticket->fecha_ingreso,
            $ticket->hora_ingreso,
            $ticket->estado_string,
        ];
    }
}
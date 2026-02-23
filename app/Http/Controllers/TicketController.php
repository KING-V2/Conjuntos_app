<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Espacio;
use App\Models\Vehiculo;
use App\Models\Tarifas;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Apartamento;
use App\Models\Administracion\Conjunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Datetime;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $ticketes = Ticket::all();
            $espacios = Espacio::all();
            $tarifas = Tarifas::all();
            $apartamentos = Apartamento::all();
            $casas = Casas::all();
            $vehiculos = Vehiculo::with('cliente')->get();
            $tickets_activos = Ticket::where('estado_ticket', 'activo')->get();
            return view('admin.tickets.add' ,
                [
                    'ticketes' => $ticketes,
                    'espacios' => $espacios,
                    'vehiculos' => $vehiculos,
                    'tarifas' => $tarifas,
                    'apartamentos' => $apartamentos,
                    'casas' => $casas,
                    'tickets_activos' => $tickets_activos,
                ]
            );
        }
    }

    public function buscar_vehiculo($id)
    {
        $vehiculo = Vehiculo::with('cliente')->find($id);
        return view('admin.tickets.buscar_vehiculo', compact ('vehiculo'));
    }

    public function imprimir_ticket($id)
    {
        $ticket = Ticket::with(['apartamento', 'casa', 'vehiculo', 'cliente'])->find($id);
        $conjunto = Conjunto::first();
        $fecha_hora = Carbon::now()->format('H:i:s');
        $pdf =  PDF::loadView('admin.tickets.ticket_pdf', compact('ticket' , 'conjunto', 'fecha_hora'));

        // Configuración para impresora térmica (80mm de ancho, alto automático)
        $pdf->setOptions([
            'dpi' => 120,
            'defaultPaperSize' => [0, 0, 226.77, 0], // 80mm = 226.77 puntos
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial Narrow'
        ]);

        $pdf->setPaper([0, 0, 226.77, 300]); // 80mm de ancho, alto infinito
        return $pdf->stream("ticket.pdf");
    }


    public function finalizar_ticket($id)
    {
        $ticket = Ticket::find($id);

        $fecha_hora_ingreso = new DateTime($ticket->fecha_ingreso. " " .$ticket->hora_ingreso);
        $fecha_hora_salida = new DateTime(Carbon::now());

        $diff = $fecha_hora_ingreso->diff($fecha_hora_salida);
        $dias_calculado = $diff->days;
        $horas_calculado = $diff->h;
        $minutos_calculado = $diff->i;

        //diferencia en minutos

        $diferencia_minutos = ($diff->h *60)  + ($diff->i * 60);

        $tiempo_total = $dias_calculado." Dias con " .$horas_calculado."Horas con " .$minutos_calculado." minutos";

        $monto_total = 0; // valor por defecto

        switch($ticket->tarifa->tipo){
            case 'por_hora':
                switch($ticket->tarifa->nombre)
                {
                    case 'regular':
                        if($minutos_calculado > $ticket->tarifa->minutos_gavela){
                        $horas_calculado = $horas_calculado +1;
                        }else{
                        $horas_calculado = $horas_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_hora')->where('nombre', 'regular')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'nocturno':
                        if($minutos_calculado > $ticket->tarifa->minutos_gavela){
                            $horas_calculado = $horas_calculado +1;
                        }else{
                            $horas_calculado = $horas_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_hora')->where('nombre', 'nocturno')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'fin_de_semana':
                        if($minutos_calculado > $ticket->tarifa->minutos_gavela){
                            $horas_calculado = $horas_calculado +1;
                        }else{
                            $horas_calculado = $horas_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_hora')->where('nombre', 'fin_de_semana ')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'feriados':
                        if($minutos_calculado > $ticket->tarifa->minutos_gavela){
                            $horas_calculado = $horas_calculado +1;
                        }else{
                            $horas_calculado = $horas_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_hora')->where('nombre', 'feriados ')->first();
                        $monto_total = $precio->costo;
                    break;

                } 
            break;

            case 'por_dia':
                switch($ticket->tarifa->nombre)
                {
                    case 'regular':
                        if($diferencia_minutos > $ticket->tarifa->minutos_gavela){
                        $dias_calculado = $dias_calculado +1;
                        }else{
                        $dias_calculado = $dias_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_dia')->where('nombre', 'regular')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'nocturno':
                        if($diferencia_minutos > $ticket->tarifa->minutos_gavela){
                        $dias_calculado = $dias_calculado +1;
                        }else{
                        $dias_calculado = $dias_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_dia')->where('nombre', 'nocturno')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'fin_de_semana':
                        if($diferencia_minutos > $ticket->tarifa->minutos_gavela){
                        $dias_calculado = $dias_calculado +1;
                        }else{
                        $dias_calculado = $dias_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_dia')->where('nombre', 'fin_de_semana')->first();
                        $monto_total = $precio->costo;
                    break;
                    case 'feriados':
                        if($diferencia_minutos > $ticket->tarifa->minutos_gavela){
                        $dias_calculado = $dias_calculado +1;
                        }else{
                        $dias_calculado = $dias_calculado;
                        };
                        $precio = Tarifas::where('tipo', 'por_dia')->where('nombre', 'feriados')->first();
                        $monto_total = $precio->costo;
                    break;

                } 
            break;
        }

            //Actualizar ticket en la base de datos
            $fecha_hora = Carbon::now();
            $tarifa = $ticket->tarifa;
            $ticket->tarifa_id = $tarifa->id;
            $ticket->fecha_salida = $fecha_hora->toDateString();
            $ticket->hora_salida = $fecha_hora->toTimeString();
            $ticket->tiempo_total = $tiempo_total;
            $ticket->monto_total = $monto_total;
            $espacio = Espacio::findOrFail($ticket->espacio_id);
            $espacio->estado = 'disponible';
            $espacio->save();
            $ticket->estado_ticket = 'completado';
            $ticket->save();

            return redirect('tickets')
                ->with('mensaje', 'Ticket facturado correctamente')
                ->with('icono', 'success')
                ->with('ticket_id', $ticket->id);
 
    }


    public function exportarTickets(Request $request)
    {
        
        $mes  = $request->input('mes');
        $anio = $request->input('anio');

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\TicketsExport($mes, $anio),
            'reporte-tickets.xlsx'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try{


    $request->validate([
        'espacio_id' => 'required',
        'vehiculo_id' => 'required',
        'tarifa_id' => 'required',
        'apartamento_id' => 'nullable|exists:apartamentos,id',
        'casas_id' => 'nullable|exists:casas,id',
    ]);


        // Verificar que el vehículo no tenga ya un ticket activo en otro espacio
        $ticket_activo = Ticket::where('vehiculo_id', $request->vehiculo_id)
        ->where('estado_ticket', 'activo')
        ->first();

        if ($ticket_activo) {
        session()->flash('flash_error_message', 'Error: Este vehículo ya tiene un espacio asignado (Espacio #' . $ticket_activo->espacio_id . ')');
        return redirect()->back();
        }

        // Verificar que la placa no esté activa en otro espacio
        $vehiculo = Vehiculo::find($request->vehiculo_id);
        $placa_activa = Ticket::whereHas('vehiculo', function($q) use ($vehiculo) {
            $q->where('placa', $vehiculo->placa);
        })
        ->where('estado_ticket', 'activo')
        ->first();

        if ($placa_activa) {
        session()->flash('flash_error_message', 'Error: La placa ' . $vehiculo->placa . ' ya está registrada en un espacio activo');
        return redirect()->back();
        }


    $vehiculo = Vehiculo::find($request->vehiculo_id);

    $ticket = new Ticket();
    $ticket->espacio_id = $request->espacio_id;
    $ticket->cliente_id = $vehiculo->cliente_id;
    $ticket->vehiculo_id = $request->vehiculo_id;
    $ticket->tarifa_id = $request->tarifa_id;
    $ticket->apartamento_id = $request->apartamento_id;
    $ticket->casas_id = $request->casas_id;
    $ultimo_ticket = DB::table('tickets')->max('id');
    $siguiente_ticket = $ultimo_ticket ? $ultimo_ticket + 1 : 1;
    $codigo_ticket = 'TK-'.$siguiente_ticket;

    $fecha_hora = Carbon::now();

    $ticket->codigo_ticket = $codigo_ticket;
    $ticket->fecha_ingreso = $fecha_hora->toDateString();
    $ticket->hora_ingreso = $fecha_hora->toTimeString();
    $ticket->estado_ticket = 'activo';
    $ticket->obs = $request->obs;
    $espacio = Espacio::find($request->espacio_id);
    $espacio->estado = 'ocupado';
    $espacio->save();
    $ticket->save();
        session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('tickets');
}

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)  // Cambiar Ticket $ticket por $id
{
        $ticket = Ticket::findOrFail($id);
        $espacio = Espacio::findOrFail($ticket->espacio_id);
        $espacio->estado = 'disponible';
        $espacio->save();
        $ticket->delete();
        return redirect('tickets')
        ->with('mensaje', 'Ticket cancelado correctamente')
        ->with('icono', 'success');
}



}

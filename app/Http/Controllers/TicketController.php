<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Espacio;
use App\Models\Vehiculo;
use App\Models\Tarifas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            $vehiculos = Vehiculo::with('cliente')->get();
            return view('admin.tickets.add' ,
                [
                    'ticketes' => $ticketes,
                    'espacios' => $espacios,
                    'vehiculos' => $vehiculos,
                    'tarifas' => $tarifas,
                ]
            );
        }
    }

    public function buscar_vehiculo($id)
    {
        $vehiculo = Vehiculo::with('cliente')->find($id);
        return view('admin.tickets.buscar_vehiculo', compact ('vehiculo'));
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
    ]);

    $vehiculo = Vehiculo::find($request->vehiculo_id);

    $ticket = new Ticket();
    $ticket->espacio_id = $request->espacio_id;
    $ticket->cliente_id = $vehiculo->cliente_id;
    $ticket->vehiculo_id = $request->vehiculo_id;
    $ticket->tarifa_id = $request->tarifa_id;

    
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
    public function destroy(Ticket $ticket)
    {
        //
    }
}

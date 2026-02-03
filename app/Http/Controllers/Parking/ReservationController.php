<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Parking\Client;
use App\Models\Parking\Vehicle;
use App\Models\Parking\Space;

class ReservationController extends Controller
{
    // Mostrar formulario de reservas
    public function index()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        $spaces   = Space::all();

        return view("admin.parking.reservation", compact("clients", "vehicles", "spaces"));
    }

    // Guardar nueva reserva
    public function store(Request $request)
    {
        $vehiculo   = Vehicle::where('placa', $request->input('vehicle_plate'))->first();
        $spaces     = Space::where('numero', $request->input('space_number'))->first(); 
        $spaces     = Space::where('numero', $request->input('space_number'))->first(); 
        $clients   = Client::where('placa', $request->input('vehicle_plate'))->first();

        "vehicle_plate" => "BUP25F"
        "space_number" => "3"
        "reservation_date" => "2025-11-21"
        "client_name" => "mario"


        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'vehicle_id'  => 'required|exists:vehicles,id',
            'space_id'    => 'required|exists:spaces,id',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'   => 'nullable|date|after_or_equal:fecha_inicio',
            'estado'      => 'required|in:pendiente,activa,finalizada,cancelada',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservation')->with('success', 'Reserva registrada correctamente.');
    }
}

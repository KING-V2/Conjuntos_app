<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Espacio;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Tarifas;
use App\Models\User;
use Illuminate\Http\Request;

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
            $vehiculos = Vehiculo::all();
            $clientes = Cliente::all();
            $tarifas = Tarifas::all();
            $users = User::all();
            return view('admin.tickets.add' ,
                [
                    'ticketes' => $ticketes,
                    'espacios' => $espacios,
                    'vehiculos' => $vehiculos,
                    'clientes' => $clientes,
                    'tarifas' => $tarifas,
                    'users' => $users
                ]
            );
        }
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
        //
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

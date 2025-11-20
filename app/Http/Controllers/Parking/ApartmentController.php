<?php

namespace App\Http\Controllers\Parking;

use App\Models\Parking\Apartment;
use App\Models\Parking\Client;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('client')->get();
        $clients = Client::all();

        return view('admin.parking.apartment', compact('apartments', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'number'    => 'nullable|string|max:50',
            'block'     => 'nullable|string|max:50',
            'floor'     => 'nullable|integer',
            'address'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
            'notes'     => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        Apartment::create([
            'name'      => $request->name,
            'number'    => $request->number,
            'block'     => $request->block,
            'floor'     => $request->floor,
            'address'   => $request->address,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'notes'     => $request->notes,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('apartments.index')->with('success', 'Apartamento creado correctamente.');
    }
}

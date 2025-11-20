<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Parking\Client;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.parking.client');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:50|unique:clients,cedula',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email',
            'direccion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $clients = \App\Models\Client::where('nombre', 'like', "%$query%")
            ->orWhere('cedula', 'like', "%$query%")
            ->limit(5)
            ->get(['id', 'nombre', 'telefono']);

        return response()->json($clients);
    }

    public function list(){
        $clients = Client::all(); // Trae todos los clientes
        return view('admin.parking.list-client', compact('clients'));
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.list')->with('success', 'Cliente eliminado correctamente.');
    }


}

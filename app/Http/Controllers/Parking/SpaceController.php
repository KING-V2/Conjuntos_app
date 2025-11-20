<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Parking\Space;

class SpaceController extends Controller
{
    public function index()
    {
        return view('admin.parking.space');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:20|unique:spaces,numero',
            'ubicacion' => 'nullable|string|max:150',
            'tipo' => 'required|in:carro,moto,bicicleta',
            'estado' => 'required|in:disponible,ocupado,reservado',
        ]);

        Space::create($request->all());

        return redirect()->route('spaces.index')->with('success', 'Espacio registrado correctamente.');
    }
}

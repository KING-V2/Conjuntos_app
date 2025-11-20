<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Parking\Vehicle;

class VehicleController extends Controller
{
    // Mostrar formulario de registro
    public function index()
    {
        return view("admin.parking.vehicle");
    }

    // Guardar vehículo
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:20|unique:vehicles,placa',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'propietario' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ], [
            'placa.unique' => 'La placa ingresada ya fue registrada en el sistema.',
        ]);

        Vehicle::create($request->only('placa', 'marca', 'modelo', 'propietario', 'descripcion'));

        return redirect()->route('vehicles.list')->with('success', 'Vehículo registrado correctamente.');
    }

    // Buscar vehículos
    public function search(Request $request)
    {
        $query = $request->get('q');
        $vehicles = Vehicle::where('placa', 'like', "%{$query}%")->get();
        return response()->json($vehicles);
    }

    // Listar vehículos
    public function list()
    {
        $vehicles = Vehicle::all();
        return view("admin.parking.list-vehicles", compact('vehicles'));
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.parking.vehicle-edit', compact('vehicle'));
    }

    // Actualizar vehículo
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'placa' => 'required|string|max:20|unique:vehicles,placa,' . $vehicle->id,
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'propietario' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ], [
            'placa.unique' => 'La placa ingresada ya fue registrada en el sistema.',
        ]);

        $vehicle->update($request->only('placa', 'marca', 'modelo', 'propietario', 'descripcion'));

        return redirect()->route('vehicles.list')->with('success', 'Vehículo actualizado correctamente.');
    }

    // Eliminar vehículo
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.list')->with('success', 'Vehículo eliminado correctamente.');
    }
}

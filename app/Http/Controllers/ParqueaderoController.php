<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParqueaderoRequest;
use App\Http\Requests\UpdateParqueaderoRequest;
use App\Models\Administracion\Parqueadero;
use App\Models\Administracion\Residente;
use App\Models\Vehiculo;
use App\Models\User;


class ParqueaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parqueaderos = Parqueadero::all();
        $residentes = Residente::all();
        $vehiculos = Vehiculo::all();
        return view('admin.parqueaderos.add',
            [
                'parqueaderos' => $parqueaderos,
                'residentes' => $residentes,
                'vehiculos' => $vehiculos
            ]
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
    public function store(StoreParqueaderoRequest $request)
    {
        try {
            $parqueadero   = new Parqueadero();
            $parqueadero->nombre           = $request->input('nombre');
            $parqueadero->save();
            session()->flash('flash_success_message', 'adicionado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('parqueaderos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Parqueadero $parqueadero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parqueadero $parqueadero, $id)
    {
        $parqueaderos = Parqueadero::find($id);
        return view('admin.parqueaderos.edit',
            [
                'parqueaderos' => $parqueaderos
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParqueaderoRequest $request, Parqueadero $parqueadero)
    {
        try {
            $parqueadero                = Parqueadero::findOrFail($request->input('parqueadero_id'));
            $parqueadero->nombre        = $request->input('nombre');
            $parqueadero->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('parqueaderos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parqueadero $parqueadero)
    {
        //
    }

    public function listaParqueaderos()
    {
        try {
            $parqueadero = [];
            
            $parqueaderos = Parqueadero::all();
            
            if ($parqueaderos->isEmpty()) {
                return response()->json(['mensaje' => 'No hay parqueaderos disponibles.'], 200);
            }

            foreach ($parqueaderos as $value) {
                $parqueadero[] = [
                    'parqueadero' => $value->nombre ?? 'No disponible',
                ];
            }

            return response()->json($parqueadero, 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);

        } catch (\Exception $e) {
            // Manejo de errores en la consulta
            return response()->json(['error' => 'Error al recuperar los parqueaderos: ' . $e->getMessage()], 500);
        }
    }
}

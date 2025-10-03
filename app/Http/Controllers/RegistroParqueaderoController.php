<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistroParqueaderoRequest;
use App\Http\Requests\UpdateRegistroParqueaderoRequest;
use App\Models\RegistroParqueadero;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Casas;

class RegistroParqueaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = RegistroParqueadero::all();
        $vehiculos = Vehiculo::all();
        $casas = Casas::all();
        $parqueaderos = Parqueadero::orderBy('nombre', 'asc')->get();
        
        return view('admin.registro_parqueaderos.add',
            [
                'registros' => $registros,
                'vehiculos' => $vehiculos,
                'casas' => $casas,
                'parqueaderos' => $parqueaderos,
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
    public function store(StoreRegistroParqueaderoRequest $request)
    {
         try {
            $registro   = new RegistroParqueadero();
            $registro->vehiculo_id           = $request->input('vehiculo_id');
            $registro->parqueadero_id           = $request->input('parqueadero_id');
            $registro->casa_id           = $request->input('casa_id');
            $registro->save();
            session()->flash('flash_success_message', 'registro exitoso');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('registro_parqueaderos');
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistroParqueadero $registroParqueadero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistroParqueadero $registroParqueadero, $id)
    {
        $registro = RegistroParqueadero::findOrfail($id);
        $vehiculos = Vehiculo::all();
        $casas = Casas::all();
        $parqueaderos = Parqueadero::all();
        $residentes = Residente::all();
        return view('admin.registro_parqueaderos.edit',
            [
                'registro' => $registro,
                'casas' => $casas,
                'vehiculos' => $vehiculos,
                'parqueaderos' => $parqueaderos
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistroParqueaderoRequest $request, RegistroParqueadero $registroParqueadero)
    {
        try {
            $registro                = RegistroParqueadero::findOrFail($request->input('registro_parqueadero_id'));
            $registro->vehiculo_id           = $request->input('vehiculo_id');
            $registro->parqueadero_id           = $request->input('parqueadero_id');
            $registro->casa_id           = $request->input('casa_id');
            $registro->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('registro_parqueaderos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroParqueadero $registroParqueadero)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('admin.vehiculos.add',
            [
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
    public function store(StoreVehiculoRequest $request)
    {
         try {
            $vehiculo   = new Vehiculo();
            $vehiculo->placa           = $request->input('placa');
            $vehiculo->tipo_vehiculo           = $request->input('tipo_vehiculo');
            $vehiculo->save();
            session()->flash('flash_success_message', 'registro exitoso');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('vehiculos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo, $id)
    {
        $vehiculos = Vehiculo::find($id);
        return view('admin.vehiculos.edit',
            [
                'vehiculo' => $vehiculos
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehiculoRequest $request, Vehiculo $vehiculo)
    {
        try {
            $vehiculo                = Vehiculo::findOrFail($request->input('vehiculo_id'));
            $vehiculo->placa        = $request->input('placa');
            $vehiculo->tipo_vehiculo        = $request->input('tipo_vehiculo');
            $vehiculo->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('vehiculos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}

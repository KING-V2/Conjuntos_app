<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $vehiculos = Vehiculo::all();
            $tipo = ['carro','moto', 'camion'];
            return view ('admin.vehiculos.add',
            [
                'vehiculos' => $vehiculos,
                'tipo' => $tipo
            ]
        );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $request->validate([
            'cliente_id' => 'required',
            'placa' => 'required|unique:vehiculos,placa',
            'marca' => 'required',
            'tipo' => 'required',
        ]);

        $vehiculo = new Vehiculo();
        $vehiculo->cliente_id  = $request->cliente_id;
        $vehiculo->placa  = strtoupper($request->input('placa'));
        $vehiculo->marca  = $request->input('marca');
        $vehiculo->tipo  = $request->input('tipo');
        $vehiculo->save();
        session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clientes/' . $request->cliente_id);

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
        {
            try {
                $vehiculos = Vehiculo::findOrfail($id);
                $tipo = ['carro','moto', 'camion'];
                return view('admin.vehiculos.edit',
                    [
                    'vehiculos' => $vehiculos,
                    'tipo' => $tipo
                    ]
                );
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
                return redirect()->back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $clienteId = $vehiculo->cliente_id;
            $vehiculo->placa  = $request->input('placa');
            $vehiculo->marca  = $request->input('marca');
            $vehiculo->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect()->back();
        }
         return redirect('clientes/' . $clienteId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo,$id)
    {
        try {
            $vehiculo = Vehiculo::find($id);
            $clienteId = $vehiculo->cliente_id;
            $vehiculo->delete();
            session()->flash('flash_success_message', 'eliminado');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
            return redirect()->back();
        }
         return redirect('clientes/' . $clienteId);
    }
}

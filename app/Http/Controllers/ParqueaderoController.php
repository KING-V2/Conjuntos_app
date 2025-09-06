<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParqueaderoRequest;
use App\Http\Requests\UpdateParqueaderoRequest;
use App\Models\Administracion\Parqueadero;
use App\Models\Administracion\Residente;
use App\Models\User;


class ParqueaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $parqueaderos = Parqueadero::all();
        $parqueaderos = Parqueadero::with(['residente.bloque', 'residente.apartamento'])->get();
        $residente = Residente::all();
        return view('admin.parqueaderos.add',
            [
                'parqueaderos' => $parqueaderos,
                'usuarios' => $residente
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
            $parqueadero->usuario_id        = $request->input('usuario_id');
            $parqueadero->estado              = $request->input('estado');
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
        $propietarios = User::all();
        return view('admin.parqueaderos.edit',
            [
                'parqueaderos' => $parqueaderos,
                'usuarios' => $propietarios
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
            $parqueadero->usuario_id    = $request->input('usuario_id');
            $parqueadero->estado        = $request->input('estado');
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
                    'estado' => $value->estado ?? 'No disponible',
                    'usuario' => $value->usuario->name ?? 'No disponible',
                ];
            }

            return response()->json($parqueadero, 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);

        } catch (\Exception $e) {
            // Manejo de errores en la consulta
            return response()->json(['error' => 'Error al recuperar los parqueaderos: ' . $e->getMessage()], 500);
        }
    }
}

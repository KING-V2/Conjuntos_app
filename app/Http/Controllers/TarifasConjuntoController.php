<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTarifasConjuntoRequest;
use App\Http\Requests\UpdateTarifasConjuntoRequest;
use App\Models\Parqueaderos\TarifasConjunto;

class TarifasConjuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tarifas_conjunto = TarifasConjunto::all();
            return view('admin.tarifas_conjunto.add',
                [
                    'tarifas_conjunto' => $tarifas_conjunto
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
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
    public function store(StoreTarifasConjuntoRequest $request)
    {
        try {
            $tarifasConjunto = new TarifasConjunto();
            $tarifasConjunto->tipo          = $request->input('tipo');
            $tarifasConjunto->descripcion   = $request->input('descripcion');
            // $tarifasConjunto->estado        = $request->input('estado');
            $tarifasConjunto->estado        = 'Activo';
            $tarifasConjunto->valor         = $request->input('valor');
            $tarifasConjunto->save();
            $json = json_encode( $request->all() );
            log_evento('tarifasConjunto Store', $json);    

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('tarifas_conjunto');
    }

    /**
     * Display the specified resource.
     */
    public function show(TarifasConjunto $tarifasConjunto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TarifasConjunto $tarifasConjunto,$id)
    {
        try {
            $tarifasConjunto = TarifasConjunto::find($id);
            return view('admin.tarifas_conjunto.edit',
                [
                    'tarifasConjunto' => $tarifasConjunto,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTarifasConjuntoRequest $request, TarifasConjunto $tarifasConjunto)
    {
        try {
            $tarifasConjunto = TarifasConjunto::find($request->input('tarifa_id'));
            $tarifasConjunto->tipo          = $request->input('tipo');
            $tarifasConjunto->descripcion   = $request->input('descripcion');
            $tarifasConjunto->estado        = $request->input('estado');
            $tarifasConjunto->valor         = $request->input('valor');
            $tarifasConjunto->save();
            $json = json_encode( $request->all() );
            log_evento('tarifasConjunto Update', $json);    

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('tarifas_conjunto');
        
    }

    /**
     * Remove the specified resource from storage.
     */ 
    public function destroy(TarifasConjunto $tarifasConjunto,$id)
    {
        try {
            $tarifas = TarifasConjunto::find($id);
            $tarifas->delete();
            return response()->json([
                'statusCode' => 200,
                'success' => 'registro eliminado'
            ], 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
            
        }catch ( \Exception $exception){
            return response()->json([
                'statusCode' => 500,
                'error' => $exception->getMessage()
            ], 500, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
        }
    }
}

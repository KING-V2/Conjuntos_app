<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBloqueRequest;
use App\Http\Requests\UpdateBloqueRequest;
use App\Models\Administracion\Bloque;
use App\Models\User;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Apartamento;
use Illuminate\Http\Request;



class BloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bloques = Bloque::all();
            $conjunto = Conjunto::first();
            $residentes = Residente::all();
            $apartamentos = Apartamento::all();
            $usuarios = User::all();
            return view('admin.bloques.add',
                [
                    'bloques' => $bloques,
                    'conjunto' => $conjunto,
                    'residentes' => $residentes,
                    'usuarios' => $usuarios,
                    'apartamentos' => $apartamentos
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
    public function create( Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBloqueRequest $request)
    {
        try {
            $bloque = new Bloque();
            $bloque->nombre        = $request->input('nombre');
            $bloque->codigo        = '0000';
            $bloque->conjunto_id   = Conjuntos::first()->id;       
            $bloque->save();
            $json = json_encode( $request->all() );
            log_evento('Registro Bloque', $json);
            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('bloques');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bloque $bloque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bloque $bloque, $id)
    {
        try{
            $bloque     = Bloque::findOrFail( $id );
            $conjunto   = Conjunto::all();
            return view('admin.bloques.edit',
                [
                    'bloque'    => $bloque,
                    'conjuntos'  => $conjunto,
                ]
            );
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('bloques');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloqueRequest $request, Bloque $bloque)
    {
        try {
            $bloque =   Bloque::find( $request->input('bloque_id') );
            $bloque->nombre        = $request->input('nombre');
            $bloque->codigo        = $request->input('codigo');
            $bloque->conjunto_id   = $request->input('conjunto_id');
            $bloque->save();
            $json = json_encode( $request->all() );
            log_evento('Actualizacion Bloque', $json);    
            session()->flash('flash_success_message', 'actualizacion correcta');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('bloques');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloque $bloque, $id)
    {
        try {
            $bloque = Bloque::find( $id );
            $bloque->delete();
            $json = json_encode( $request->all() );

            log_evento('Eliminacion Bloque', [
                'id' => $id
            ]);
            session()->flash('flash_success_message', 'registro eliminado');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('bloques');
    }

    public function getBloques($conjunto_id) {
        $bloques = Bloque::where('conjunto_id', $conjunto_id)->get();
        return response()->json($bloques);
    }

    public function getBloquesApi() {
        $bloques = Bloque::all();
        return response()->json($bloques);
    }
}

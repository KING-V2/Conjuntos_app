<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForoRequest;
use App\Http\Requests\UpdateForoRequest;
use App\Models\Encuestas\Foro;
use App\Models\RespuestaForo;


class ForoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foros = Foro::all();
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return view('admin.foros.add',
            [
                'foros' => $foros,
                'meses' => $meses
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
    public function store(StoreForoRequest $request)
    {
        try {
            $existentes = Foro::where('estado','Activo')->get();
            foreach ($existentes as $value) {
                $value->estado = 'No Activo';
                $value->save();
            }

            $foro = new Foro();
            $foro->mes          = $request->input('mes');
            $foro->titulo       = $request->input('titulo');
            $foro->descripcion  = $request->input('descripcion');
            $foro->estado       = $request->input('estado');
            $foro->save();
            session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('foros');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foro $foro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foro $foro, $id)
    {
        try {
            $foro = Foro::findOrfail($id);
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            return view('admin.foros.edit',
                [
                    'foro' => $foro,
                    'meses' => $meses
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect('foros');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForoRequest $request, Foro $foro)
    {
        try {
            $foro = Foro::findOrfail($request->input('foro_id'));
            $foro->mes          = $request->input('mes');    
            $foro->titulo       = $request->input('titulo');    
            $foro->descripcion  = $request->input('descripcion');
            $foro->estado       = $request->input('estado');
            $foro->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('foros');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foro $foro, $id)
    {
        try {
            $foro = Foro::findOrFail( $id );
            
            //eliminacion de las respuestas del foro
            $respuestaforo = RespuestaForo::where('foro_id', $id )->get();
            foreach ($respuestaforo as $value) {
                $value->delete();
            }

            if( $foro->delete() ){
                session()->flash('flash_success_message', 'registro eliminado correctamente');
            }
            else
            {
                session()->flash('flash_error_message', 'Ocurrió un eliminando el registro');
            }
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('foros');
    }

    public function getForo()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $foros = Foro::first()->where('estado','Activo')->get();
        return response()->json($foros, 200, ['Content-Type' => 'application/json','charset' => 'utf-8']);
    }
}

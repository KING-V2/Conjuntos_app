<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitanteRequest;
use App\Http\Requests\UpdateVisitanteRequest;
use App\Models\Visitante;
use App\Models\Administracion\Residente;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $visitantes = Visitante::all();
            $residentes = Residente::get();
            return view('admin.visitantes.add',
                [
                    'visitantes' => $visitantes,
                    'residentes' => $residentes,
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
    public function store(StoreVisitanteRequest $request)
    {
        try {
            $visitantes = new Visitante();
            $visitantes->nombre             = $request->input('nombre');
            $visitantes->tipo_documento     = $request->input('tipo_documento');
            $visitantes->documento          = $request->input('documento');
            $visitantes->residente_id       = $request->input('residente_id');
            $visitantes->placa              = $request->input('placa') ?? null;
            $visitantes->hora_ingreso       = now();
            $visitantes->hora_salida        = null;
            $visitantes->save();
            $json = json_encode( $request->all() );
            log_evento('Visitantes Store', $json);    

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('visitantes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitante $visitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitante $visitante, $id)
    {
        try {
            $visitante = Visitante::find($id);
            $residentes = Residente::get();
            return view('admin.visitantes.edit',
                [
                    'visitante' => $visitante,
                    'residentes' => $residentes,
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
    public function update(UpdateVisitanteRequest $request)
    {
        try {
            $visitante = Visitante::find($request->input('visitante_id'));
            $visitante->nombre             = $request->input('nombre');
            $visitante->tipo_documento     = $request->input('tipo_documento');
            $visitante->documento          = $request->input('documento');
            $visitante->placa              = $request->input('placa') ?? null;
            $visitante->hora_ingreso       = $visitante->hora_ingreso;
            $visitante->hora_salida        = null;
            $visitante->save();
            $json = json_encode( $request->all() );
            log_evento('Visitantes Store', $json);    

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('visitantes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function registroSalidaVisitante($id)
    {
        try {
            $visitante = Visitante::find($id);
            $visitante->hora_salida  = now();
            $visitante->save();
            $json = json_encode( $request->all() );
            log_evento('Visitantes Exit', $json);
            session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('visitantes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitante $visitante,$id)
    {
        try {
            $visitante = Visitante::find($id);
            $visitante->delete();
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

    /**
     * Display a listing of the resource.
     */
    public function listaVisitantes()
    {
        try {
            $visitantes = Visitante::all();
            $residentes = Residente::get();
            return view('admin.visitantes.add',
                [
                    'visitantes' => $visitantes,
                    'residentes' => $residentes,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    public function registroVisitante(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        try {
            $encuesta = new Visitante();
            $encuesta->nombre             = $request->input('nombre');
            $encuesta->tipo_documento     = $request->input('tipo_documento');
            $encuesta->documento          = $request->input('documento');
            $encuesta->placa              = $request->input('placa') ?? null;
            $encuesta->residente_id       = $request->input('residente_id');
            $encuesta->hora_ingreso       = now();
            $encuesta->hora_salida        = null;
            $encuesta->save();
            return response()->json('Visitante Registrado', 200, $header);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage(), 500, $header);
        }
    }

    public function salidaVisitante(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        try {
            $encuesta = Visitante::find($request->input('visitante_id'));
            $encuesta->hora_salida  = now();
            $encuesta->save();
            return response()->json('Salida Registrada', 200, $header);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage(), 500, $header);
        }
    }
}

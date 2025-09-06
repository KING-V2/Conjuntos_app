<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZonaComunRequest;
use App\Http\Requests\UpdateZonaComunRequest;
use App\Models\Reservas\ZonaComun;


class ZonaComunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas_comunes = ZonaComun::all();
        return view('admin.zonas_comunes.add',
            [
                'zonas_comunes' => $zonas_comunes
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZonaComunRequest $request)
    {
        try {
            $zona_comun = new ZonaComun();
            $zona_comun->nombre        = $request->input('nombre');
            $zona_comun->estado        = $request->input('estado');
            $zona_comun->save();
            session()->flash('flash_success_message', 'Registrada' );
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('zonas_comunes');
    }

    /**
     * Display the specified resource.
     */
    public function show(ZonaComun $zonaComun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZonaComun $zonaComun, $id )
    {
        try{
            $zona_comun = ZonaComun::findOrFail( $id );
            return view('admin.zonas_comunes.edit',
                [
                    'zona_comun' => $zona_comun
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('zonas_comunes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZonaComunRequest $request, ZonaComun $zonaComun)
    {
        try {

            $zona_comun             = ZonaComun::findOrFail( $request->input('zona_comun_id') );
            $zona_comun->nombre     = $request->input('nombre');
            $zona_comun->estado     = $request->input('estado');
            $zona_comun->save();

            session()->flash('flash_success_message', 'actualizado correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('zonas_comunes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZonaComun $zonaComun, $id)
    {
        try {
            $zonas_comunes = ZonaComun::find( $id );
            $zonas_comunes->delete();

            session()->flash('flash_success_message', 'eliminado');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('zonas_comunes');
    }

    public function getZonasComunes()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $circulares = ZonaComun::where('estado', 'Activo')->get();
        return response()->json($circulares, 200, $header, JSON_UNESCAPED_UNICODE);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualRequest;
use App\Http\Requests\UpdateManualRequest;
use App\Models\Informacion\Manual;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manuales = Manual::all();
        return view('admin.manuales.add',
            [
                'manuales' => $manuales
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = $request->validate([
            'archivo' => 'required'
        ]);

        $archivo            = $request->file('archivo');
        $fecha              = date('Ymdhis');
        $file_name          = 'file_'.$fecha.'.'.$archivo->getClientOriginalExtension();

        try {
            $manual = new Manual();
            $manual->archivo        = $file_name;
            
            Storage::disk('storage_manuales')->put($file_name , file_get_contents($archivo) );
            
            try{
                $manual->save();
                session()->flash('flash_success_message', 'adicionado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('manuales');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManualRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Manual $manual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manual $manual, $id)
    {
        try{
            $manual = Manual::findOrFail( $id );
            return view('admin.manuales.edit',
                [
                    'manual' => $manual
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('manuales');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManualRequest $request, Manual $manual)
    {
        $validate = $request->validate([
            'id_manual' => 'required',
            'archivo' => 'required'
        ]);

        $id                 = $request->input('id_manual');
        
        try {
            $manual           = Manual::findOrFail( $id );
            $archivo                = $request->file('archivo');
            
            if( !empty( $archivo ) ){
                $fecha              = date('Ymdhis');
                $file_name          = 'file_'.$fecha.'.'.$archivo->getClientOriginalExtension();
                $manual->archivo        = $file_name;
                Storage::disk('storage_manuales')->put($file_name , file_get_contents($archivo) );
            }
            
            try{
                $manual->save();
                session()->flash('flash_success_message', 'actualizado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('manuales');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($id > 0) {
            try {
                $manual = Manual::find( $id );
                if( $manual->delete() ){
                    session()->flash('flash_success_message', 'eliminado correctamente');
                }
                else
                {
                    session()->flash('flash_error_message', 'Ocurrió un error eliminando el registro');
                }
            } catch (\Throwable $th) {
                //throw $th;
                session()->flash('flash_error_message', $th->getMessage());
            }
        }else{
            session()->flash('flash_error_message', 'No existe');
        }
        return redirect('manuales');
    }

    public function getManual()
    {
        // $manual = Manual::all();
        $manual = Manual::latest()->take(1)->get();

        if ( !empty( $manual ) )
        {
            return response()->json(['data' => $manual],200);
        }else{
            return response()->json(['data' => [], 'error' => 'No Existen Datos'],500);
        }
    }
}

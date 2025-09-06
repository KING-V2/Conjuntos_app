<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGaleriaConjuntoRequest;
use App\Http\Requests\UpdateGaleriaConjuntoRequest;
use App\Models\Administracion\GaleriaConjunto;
use Illuminate\Support\Facades\Storage;


class GaleriaConjuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galerias = GaleriaConjunto::all();
        return view('admin.galerias.add',
            [
                'galerias' => $galerias
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
    public function store(StoreGaleriaConjuntoRequest $request)
    {
        try {
            $fecha              = date('Ymdhis');
            $imagen               = $request->file('imagen');
            $imagen_name          = 'imagen_'.$fecha.'.'.$imagen->getClientOriginalExtension();

            $galeria   = new GaleriaConjunto();
            $galeria->descripcion           = $request->input('descripcion');
            $galeria->imagen             = $imagen_name;
            
            Storage::disk('storage_galeria_conjunto')->put($imagen_name , file_get_contents($imagen) );
            
            $galeria->save();
            session()->flash('flash_success_message', 'adicionado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('galeria_conjunto');
    }

    /**
     * Display the specified resource.
     */
    public function show(GaleriaConjunto $galeriaConjunto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriaConjunto $galeriaConjunto, $id)
    {
        try{
            $galeria = GaleriaConjunto::findOrFail( $id );
            return view('admin.galerias.edit',
                [
                    'galeria' => $galeria
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('empleados');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGaleriaConjuntoRequest $request, GaleriaConjunto $galeriaConjunto)
    {
        try {
            
            $galeria                = GaleriaConjunto::find( $request->input('id_galeria') );
            $galeria->descripcion   = $request->input('descripcion');
            
            if( $request->file('imagen') ){
                $fecha              = date('Ymdhis');
                $imagen             = $request->file('imagen');
                $imagen_name        = 'imagen_'.$fecha.'.'.$imagen->getClientOriginalExtension();
                $galeria->imagen    = $imagen_name;
                Storage::disk('storage_galeria_conjunto')->put($imagen_name , file_get_contents($imagen) );
            }
            
            $galeria->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('galeria_conjunto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleriaConjunto $galeriaConjunto, $id)
    {
        if ($id > 0) {
            try {
                $galeria_conjunto = GaleriaConjunto::find( $id );
                if( $galeria_conjunto->delete() ){
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
        return redirect('galeria_conjunto');
    }

    public function getGaleriaConjunto()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $galeria = GaleriaConjunto::get();
        return response()->json($galeria, 200, $header);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Emprendimientos\ClasificadoGaleria;
use App\Models\Emprendimientos\Clasificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreClasificadoGaleriaRequest;


class ClasificadoGaleriaController extends Controller
{
    public function index()
    {
        try {
            $galeria = ClasificadoGaleria::all();
            $clasificados = Clasificados::all();
    
            return view('admin.clasificado_galeria.add',
                [
                    'clasificados' => $clasificados,
                    'galeria' => $galeria,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    public function store(StoreClasificadoGaleriaRequest $request)
    {
        try {
            if ( $request->hasfile('imagen')) 
            {
                foreach ($request->file('imagen') as $file) 
                {
                    $fecha      = date('Ymdhis').rand(0,9);
                    $file_name  = 'imagen_'.$fecha.'.'.$file->getClientOriginalExtension();
                    $archivo = new ClasificadoGaleria();
                    $archivo->imagen        = $file_name;
                    $archivo->clasificado_id        = $request->input('clasificado_id');
                    Storage::disk('storage_clasificado_galeria')->put($file_name , file_get_contents($file) );
                    $archivo->save(); 
                }
                session()->flash('flash_success_message', 'adicionado correctamente');
            }
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clasificado_galeria');
        // return back()->withInput();
    }

    public function show( $id )
    {
        try {
            $galeria = ClasificadoGaleria::where('clasificado_id',$id)->get();
    
            return view('admin.clasificado_galeria.show',
                [
                    'clasificado_id' => $id,
                    'galeria' => $galeria,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    public function destroy($id)
    {
        $galeria = ClasificadoGaleria::find($id);
        Storage::delete('storage/clasificado_galeria/'.$galeria->imagen);
        $galeria->delete();
        return redirect('clasificado_galeria');
        // return redirect()->route('admin.clasificado_galeria.index')->with('success', 'Image removed successfully.');
    }
}

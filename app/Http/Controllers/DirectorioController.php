<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectorioRequest;
use App\Http\Requests\UpdateDirectorioRequest;
use App\Models\Informacion\Directorio;
use Illuminate\Http\Request;


class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directorios = Directorio::all();
        return view('admin.directorio.add',
            [
                'directorios' => $directorios
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
    public function store(StoreDirectorioRequest $request)
    {
        $nombre     = $request->input('nombre');
        $telefono   = $request->input('telefono');
        
        try {
            $archivo = new Directorio();
            $archivo->telefono        = $telefono;
            $archivo->nombre        = $nombre;
            
            $archivo->save();
            $json = json_encode( $request->all() );
            log_evento('Store Directorio', $json);
            session()->flash('flash_success_message', 'adicionado correctamente');

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('directorios');
    }

    /**
     * Display the specified resource.
     */
    public function show(Directorio $directorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Directorio $directorio, $id)
    {
        try{
            $directorio = Directorio::findOrFail( $id );
            return view('admin.directorio.edit',
                [
                    'directorio' => $directorio
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('directorios');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectorioRequest $request, Directorio $directorio)
    {
        $id                 = $request->input('id_directorio');
        $nombre             = $request->input('nombre');
        $telefono           = $request->input('telefono');

        try {
            $directorio           = Directorio::findOrFail( $id );
            $directorio->nombre        = $nombre;
            $directorio->telefono        = $telefono;
            
            $directorio->save();
            $json = json_encode( $request->all() );
            log_evento('Update Directorio', $json);

            session()->flash('flash_success_message', 'actualizado correctamente');

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('directorios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Directorio $directorio,$id)
    {
        if ($id > 0) {
            try {
                $empleado = Directorio::find( $id );
                log_evento('Eliminacion Numero directorio', ['id' => $id]);
                if( $empleado->delete() ){
                    session()->flash('flash_success_message', 'registro adicionado correctamente');
                    return redirect('directorios');
                }
                else
                {
                    session()->flash('flash_error_message', 'Ocurrió un error insertando el registro');
                    return redirect('directorios');
                }
            } catch (\Throwable $th) {
                //throw $th;
                session()->flash('flash_error_message', $th->getMessage());
                return redirect('directorios');
            }
        }else{
            session()->flash('flash_error_message', 'No existe el directorio');
            return redirect('directorios');
        }
    }

    public function getDirectorio()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $directorio = Directorio::get();
        return response()->json($directorio, 200, $header, JSON_UNESCAPED_UNICODE);
    }

}

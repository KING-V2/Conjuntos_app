<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCircularesRequest;
use App\Http\Requests\UpdateCircularesRequest;
use App\Models\Informacion\Circulares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class CircularesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $circulares = Circulares::all();
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            return view('admin.circulares.add',
                [
                    'circulares' => $circulares,
                    'meses' => $meses,
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
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCircularesRequest $request)
    {
        $mes                = $request->input('mes');
        $titulo             = $request->input('titulo');
        $pdf                = $request->file('archivo');
        $descripcion        = $request->input('descripcion');
        
        $fecha              = date('Ymdhis');
        $file_name          = 'file_'.$fecha.'.'.$pdf->getClientOriginalExtension();

        try {
            $archivo = new Circulares();
            $archivo->mes        = $mes;
            $archivo->titulo        = $titulo;
            $archivo->archivo        = $file_name;
            $archivo->descripcion        = $descripcion;

            $json = json_encode( $request->all() );
            log_evento('Registro Circular', $json);
            
            Storage::disk('storage_circulares')->put($file_name , file_get_contents($pdf) );
            
            try{
                $archivo->save();
                session()->flash('flash_success_message', 'adicionado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('circulares');
    }

    /**
     * Display the specified resource.
     */
    public function show(Circulares $circulares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Circulares $circulares, $id)
    {
        try{
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $circular = Circulares::findOrFail( $id );
            return view('admin.circulares.edit',
                [
                    'circular' => $circular,
                    'meses' => $meses
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('circulares');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCircularesRequest $request, Circulares $circulares)
    {
        
        $id                 = $request->input('id_circular');
        $mes                = $request->input('mes');
        $titulo             = $request->input('titulo');
        $descripcion        = $request->input('descripcion');

        try {

            $circular           = Circulares::findOrFail( $id );
            $circular->mes        = $mes;
            $circular->titulo        = $titulo;
            $circular->descripcion        = $descripcion;
            $fecha              = date('Ymdhis');
            
            if( $request->file('archivo') ){
                $pdf                = $request->file('archivo');
                $file_name          = 'file_'.$fecha.'.'.$pdf->getClientOriginalExtension();
                $circular->archivo        = $file_name;
                Storage::disk('storage_circulares')->put($file_name , file_get_contents($pdf) );
            }

            $json = json_encode( $request->all() );
            log_evento('Update Circular', $json);
            
            $circular->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('circulares');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Circulares $circulares, $id)
    {
        if ($id > 0) {
            try {
                $circular = Circulares::find( $id );
                log_evento('Destroy Circular', ['id' => $id]);
                $circular->delete();
                session()->flash('flash_success_message', 'registro eliminado correctamente');
                return redirect('circulares');
            } catch (\Throwable $th) {
                //throw $th;
                session()->flash('flash_error_message', $th->getMessage());
                return redirect('circulares');
            }
        }else{
            session()->flash('flash_error_message', 'No existe la circular');
            return redirect('circulares');
        }
    }

    public function getCircular($id)
    {
        $files     = Circulares::findOrFail( $id );

        $files_search = [];

        if ( !empty( $files ) )
        {
            $files_search = [
                'id' => $files->id,
                'mes' => $files->mes,
                'titulo' => $files->titulo,
                'archivo' => $files->archivo,
                'descripcion' => $files->descripcion,
                'fecha_publicacion' => $files->created_at,
                'fecha_actualizacion' => $files->updated_at
            ];

            return response()->json(['data' => $files_search],200,['Content-Type' => 'application/json; charset=utf-8']);
        }else{
            return response()->json(['data' => [], 'error' => 'No Existen Archivos'],500);
        }
    }

    public function getCirculares()
    {
        // Obtener el año en curso
        $currentYear = Carbon::now()->year;

        // Obtener las circulares del año en curso
        $circulares = Circulares::whereYear('created_at', $currentYear)->get();

        // Verificar si hay resultados
        if ($circulares->isEmpty()) {
            return response()->json([
                'message' => 'No hay circulares disponibles para el año en curso.'
            ], 404, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        // Retornar las circulares encontradas
        return response()->json($circulares, 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

}

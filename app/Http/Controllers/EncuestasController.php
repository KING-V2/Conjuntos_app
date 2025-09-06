<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncuestasRequest;
use App\Http\Requests\UpdateEncuestasRequest;
use App\Models\Encuestas\Encuestas;
use App\Models\EncuestasRespuestas;


class EncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encuestas = Encuestas::all();
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return view('admin.encuestas.add',
            [
                'encuestas' => $encuestas,
                'meses' => $meses,
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
    public function store(StoreEncuestasRequest $request)
    {
        try {
            $encuesta = new Encuestas();
            $encuesta->mes          = $request->input('mes');
            $encuesta->opciones     = $request->input('opciones');       
            $encuesta->descripcion  = $request->input('descripcion');
            $encuesta->estado       = $request->input('estado');
            $encuesta->tipo_residente       = $request->input('tipo_residente');
            $encuesta->save();
            session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('encuestas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Encuestas $encuestas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encuestas $encuestas, $id)
    {
        try {
            $encuesta = Encuestas::findOrfail($id);
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            return view('admin.encuestas.edit',
                [
                    'encuesta' => $encuesta,
                    'meses' => $meses
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect('encuestas');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEncuestasRequest $request)
    {
        try {
            $encuesta = Encuestas::findOrfail($request->input('encuesta_id'));
            $encuesta->mes          = $request->input('mes');
            $encuesta->opciones     = $request->input('opciones');       
            $encuesta->descripcion  = $request->input('descripcion');
            $encuesta->estado       = $request->input('estado');
            $encuesta->tipo_residente   = $request->input('tipo_residente');
            $encuesta->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('encuestas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encuestas $encuestas, $id)
    {
        try {
            $encuesta = Encuestas::findOrFail( $id );
            $encuesta_respuesta = EncuestasRespuestas::where( 'encuesta_id', $id )->get();
            foreach ($encuesta_respuesta as $respuesta) {
                $respuesta->delete();
            }   
            if( !$encuesta->delete() ){
                session()->flash('flash_error_message', 'Ocurrió un eliminando el registro');
            }
            else
            {
                session()->flash('flash_success_message', 'registro eliminado correctamente');
            }
            return redirect('encuestas');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
            return redirect('encuestas');
        }
    }

    public function getEncuesta()
    {
        date_default_timezone_set('America/Bogota');
        $fechaActual = new \DateTime();
        $nombreMes = $fechaActual->format('F');
        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        // Obtener el nombre del mes en español
        $nombreMesEnEspanol = $meses[$nombreMes];
        $encuestas = Encuestas::where('mes',$nombreMesEnEspanol)->where('estado','Activo')->get();
        return response()->json($encuestas, 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }
}

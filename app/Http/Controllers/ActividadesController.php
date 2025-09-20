<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActividadesRequest;
use App\Http\Requests\UpdateActividadesRequest;
use App\Models\Administracion\Actividades;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActividadesController extends Controller
{
    public function index()
    {
        $actividades = Actividades::all();
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return view('admin.actividades.add',
            [
                'actividades' => $actividades,
                'meses' => $meses,
            ]
        );
    }

    public function store(StoreActividadesRequest $request)
    {
        Carbon::setLocale('es');
        $mes = Carbon::now()->translatedFormat('F');
        $anio = Carbon::now()->year;


        try {
            $actividad = new Actividades();
            $actividad->anio            = $anio;
            $actividad->mes             = ucfirst($mes);
            $actividad->fecha           = date('Ymd');
            $actividad->estado          = $request->input('estado');
            $actividad->descripcion     = $request->input('descripcion');

            if( $actividad->save() ){
                session()->flash('flash_success_message', 'Registrada correctamente');
                // Log the activity
                $json = json_encode( $request->all() );
                log_evento('Registro Actividad', $json);
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('actividades');
    }

    public function show(Actividad $actividad)
    {
        return view('actividades.show', compact('actividad'));
    }

    public function edit($id)
    {
        $actividad = Actividades::findOrFail($id);
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        if (!$actividad) {
            return redirect()->route('actividades')
                             ->with('error', 'Actividad no encontrada.');
        }
        return view('admin.actividades.edit',
            [
                'actividad' => $actividad,
                'meses' => $meses,
            ]
        );
    }

    public function update(UpdateActividadesRequest $request)
    {

        try {
            $actividad = Actividades::findOrFail($request->input('actividad_id'));
    
            $actividad->estado = $request->input('estado');
            $actividad->descripcion = $request->input('descripcion');
            $actividad->save();
            // Log the activity
            $json = json_encode($request->all());
            log_evento('Actualización Actividad', $json);
            session()->flash('flash_success_message', 'Actividad actualizada correctamente');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('actividades');
    }
    
    public function destroy($id)
    {
        
        try {
            $actividad = Actividades::findOrFail($id);
            $actividad->delete();
            session()->flash('flash_success_message', 'Actividad eliminada correctamente');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('flash_error_message', $th->getMessage());
        }

        return redirect('actividades');
    }

    public function getActividades($mes)
    {
        $actividades = Actividades::where('mes', $mes)->get();
        return response()->json($actividades);
    }

    public function saveActividades(Request $request)
    {
        Carbon::setLocale('es');
        $mes = Carbon::now()->translatedFormat('F');
        $anio = Carbon::now()->year;
        
        $actividad = new Actividades();
        $actividad->anio            = $anio;
        $actividad->mes             = ucfirst($mes);
        $actividad->fecha           = date('Ymd');
        $actividad->estado          = $request->input('estado');
        $actividad->descripcion     = $request->input('descripcion');
        $actividad->save();

        return response()->json($actividad);
    }
}

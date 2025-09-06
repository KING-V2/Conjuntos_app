<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleados\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empleados = Empleado::all();
        $puestos = ['concejo','seguridad','administracion','aseo'];
        return view('admin.empleados.add',
            [
                'empleados' => $empleados,
                'puestos' => $puestos
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
    public function store(StoreEmpleadoRequest $request)
    {
        $foto               = $request->file('archivo');
        $puesto             = $request->input('puesto');
        $nombre             = $request->input('nombre');
        $fecha              = date('Ymdhis');
        $file_name          = 'file_'.$fecha.'.'.$foto->getClientOriginalExtension();

        try {
            $archivo = new Empleado();
            $archivo->puesto        = $puesto;
            $archivo->nombre        = $nombre;
            $archivo->foto          = $file_name;
            Storage::disk('storage_empleados')->put($file_name , file_get_contents($foto) );
            
            try{
                $archivo->save();
                $json = json_encode( $request->all() );
                log_evento('Registro Empleado', $json);
                session()->flash('flash_success_message', 'adicionado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('empleados');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado, $id)
    {
        try{
            $empleado = Empleado::findOrFail( $id );
            $puestos = ['concejo','seguridad','administracion','aseo'];
            return view('admin.empleados.edit',
                [
                    'empleado' => $empleado,
                    'puestos' => $puestos
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
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $validate = $request->validate([
            'id_empleado' => 'required',
            'nombre' => 'required',
            'puesto' => 'required'
        ]);

        $id                 = $request->input('id_empleado');
        $nombre                = $request->input('nombre');
        $puesto             = $request->input('puesto');

        try {

            $empleado           = Empleado::findOrFail( $id );
            $empleado->nombre        = $nombre;
            $empleado->puesto        = $puesto;
            $foto                = $request->file('archivo');
            
            if( !empty( $foto ) ){
                $fecha              = date('Ymdhis');
                $file_name          = 'file_'.$fecha.'.'.$foto->getClientOriginalExtension();
                $empleado->foto        = $file_name;
                Storage::disk('storage_empleados')->put($file_name , file_get_contents($foto) );
            }
            
            try{
                $empleado->save();
                $json = json_encode( $request->all() );
                log_evento('Actualizacion Empleado', $json);
                session()->flash('flash_success_message', 'actualizado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('empleados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado, $id)
    {
        if ($id > 0) {
            try {
                $empleado = Empleado::find( $id );
                log_evento('Eliminacion Empleado', ['id' => $id]);
                if( $empleado->delete() ){
                    session()->flash('flash_success_message', 'registro adicionado correctamente');
                    return redirect('empleados');
                }
                else
                {
                    session()->flash('flash_error_message', 'Ocurrió un error insertando el registro');
                    return redirect('empleados');
                }
            } catch (\Throwable $th) {
                //throw $th;
                session()->flash('flash_error_message', $th->getMessage());
                return redirect('empleados');
            }
        }else{
            session()->flash('flash_error_message', 'No existe el empleado');
            return redirect('empleados');
        }
    }

    public function getEmpleados()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $empleados = Empleado::get();
        return response()->json($empleados, 200, $header, JSON_UNESCAPED_UNICODE);
    }
    
    public function getEmpleadosByPuesto($puesto)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $empleados = Empleado::where('puesto',$puesto)->get();
        return response()->json($empleados, 200, $header, JSON_UNESCAPED_UNICODE);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmprendimientosRequest;
use App\Http\Requests\UpdateEmprendimientosRequest;
use App\Models\Emprendimientos\GaleriaEmprendimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Emprendimientos\Emprendimientos;


class EmprendimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprendimientos = Emprendimientos::all();
        return view('admin.emprendimientos.add',
            [
                'emprendimientos' => $emprendimientos
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    public function files_datatable()
    {
        $files = Emprendimientos::all();
        $files_json = [];
        if ( !empty( $files ) )
        {
            foreach ($files as $value) {
                $files_json [] = [
                    'id'            => $value->id,
                    'titulo'        => $value->titulo,
                    'imagen'        => $value->imagen,
                    'whatsapp'      => $value->whatsapp,
                    'instagram'     => $value->instagram
                ];
            }
            return response()->json(['data' => $files_json],200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmprendimientosRequest $request)
    {
        $titulo         = $request->input('titulo');
        $imagen         = $request->file('imagen');
        $instagram      = $request->input('instagram');
        $mes      = '-';
        $whatsapp       = $request->input('whatsapp');

        $fecha      = date('Ymdhis').rand(0,9);
        $file_name  = 'file_'.$fecha.'.'.$imagen->getClientOriginalExtension();

        try {
            $archivo = new Emprendimientos();
            $archivo->titulo        = $titulo;
            $archivo->whatsapp      = $whatsapp;
            $archivo->instagram     = $instagram;
            $archivo->imagen        = $file_name;
            $archivo->mes        = $mes;
            
            Storage::disk('storage_files')->put($file_name , file_get_contents($imagen) );
            
            try{
                $archivo->save();
                session()->flash('flash_success_message', 'adicionado correctamente');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
                // session()->flash('flash_error_message', 'Error de guardado' );
            }
        }catch ( \Exception $exception){
            // session()->flash('flash_error_message', $exception->getMessage() );
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('emprendimientos');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emprendimientos $emprendimientos, Request $request, $id )
    {
        try{
            $emprendimiento = Emprendimientos::findOrFail( $id );

            return view('admin.emprendimientos.edit',
                [
                    'emprendimiento' => $emprendimiento
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('emprendimientos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmprendimientosRequest $request, Emprendimientos $emprendimientos)
    {

        $titulo         = $request->input('titulo');
        $instagram      = $request->input('instagram');
        $whatsapp       = $request->input('whatsapp');
        $mes       = '-';
        $imagen         = $request->file('imagen');
        $id             = $request->input('id_emprendimiento');
        
        try {
            $archivo = Emprendimientos::findOrFail($id);
            
            if( !empty( $imagen ) ){
                $fecha      = date('Ymdhis').rand(0,9);
                $file_name  = 'file_'.$fecha.'.'.$imagen->getClientOriginalExtension();
                $archivo->imagen    = $file_name;
                Storage::disk('storage_files')->put($file_name , file_get_contents($imagen) );
            }

            $archivo->titulo        = $titulo;
            $archivo->mes        = $mes;
            $archivo->whatsapp      = $whatsapp;
            $archivo->instagram     = $instagram;
            
            try{
                $archivo->save();
                session()->flash('flash_success_message', 'actualizado correctamente');
            }catch ( \Exception $exception){
                // session()->flash('flash_error_message', $exception->getMessage() );
                session()->flash('flash_error_message', $exception->getMessage().' mensaje guardar' );
            }

        }catch ( \Exception $exception){
            // session()->flash('flash_error_message', $exception->getMessage() );
            session()->flash('flash_error_message', $exception->getMessage().' mensaje cargue' );
        }
        // return redirect('emprendimientos');
        return redirect()->route('emprendimientos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            GaleriaEmprendimientos::where('emprendimiento_id',$id )->delete();
            
            $emprendimiento = Emprendimientos::find( $id );
            if ($emprendimiento) {
                $emprendimiento->delete();
            }
            $emprendimiento->delete();
            log_evento('Emprendimeinto Destroy', ['id' => $id]);
            session()->flash('flash_success_message', 'eliminado');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('emprendimientos');
    }

    public function getEmprendimientos()
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
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $emprendimientos = Emprendimientos::where('mes',$nombreMesEnEspanol)->get();
        return response()->json($emprendimientos, 200, $header, JSON_UNESCAPED_UNICODE);
    }
}

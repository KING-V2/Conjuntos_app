<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorrespondenciaRequest;
use App\Http\Requests\UpdateCorrespondenciaRequest;
use App\Models\Correspondencia\Correspondencia;
use App\Models\Administracion\Bloque;
use App\Models\Administracion\Residente;
use Illuminate\Http\Request;


class CorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $correspondencia = Correspondencia::all();
        $bloques = Bloque::all();
        return view('admin.correspondencia.add',
            [
                'correspondencias' => $correspondencia,
                'bloques' => $bloques,
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
    public function store(StoreCorrespondenciaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Correspondencia $correspondencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Correspondencia $correspondencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCorrespondenciaRequest $request, Correspondencia $correspondencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Correspondencia $correspondencia)
    {
        //
    }

    public function sumarElemento(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $correspondencia = Correspondencia::find($request->input('id'));
        $status = true;
        
        try {
            switch ( $request->input('elemento') ) {
                case 'luz':
                    $correspondencia->luz = $correspondencia->luz +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar luz', $json);
                    break;
                case 'agua':
                    $correspondencia->agua = $correspondencia->agua +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar agua', $json);
                    break;
                case 'gas':
                    $correspondencia->gas = $correspondencia->gas +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar gas', $json);
                    break;
                case 'mensajes':
                    $correspondencia->mensajes = $correspondencia->mensajes +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar mensajes', $json);
                    break;
                case 'paquetes':
                    $correspondencia->paquetes = $correspondencia->paquetes +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar paquetes', $json);
                    break;
                default:
                    $status = false;
                    break;
            }
            session()->flash('flash_success_message', 'Almacenado' );
            return response()->json(['status' => $status, 'message' => 'Almacenado'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
            return response()->json(['status' => $status, 'message' => $th->getMessage()], 500, $header, JSON_UNESCAPED_UNICODE);
        }

    }

    public function restarElemento(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $correspondencia = Correspondencia::find($request->input('id'));
        $status = true;

        try {
            switch ( $request->input('elemento') ) {
                case 'luz':
                    $correspondencia->luz > 0 ? ($correspondencia->luz = $correspondencia->luz -1) : $correspondencia->luz = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar luz', $json);
                    break;
                case 'agua':
                    $correspondencia->agua > 0 ? ($correspondencia->agua = $correspondencia->agua -1) : $correspondencia->agua = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar agua', $json);
                    break;
                case 'gas':
                    $correspondencia->gas > 0 ? ($correspondencia->gas = $correspondencia->gas -1) : $correspondencia->gas = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar gas', $json);
                    break;
                case 'mensajes':
                    $correspondencia->mensajes > 0 ? ($correspondencia->mensajes = $correspondencia->mensajes -1) : $correspondencia->mensajes = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar mensajes', $json);
                    break;
                case 'paquetes':
                    $correspondencia->paquetes > 0 ? ($correspondencia->paquetes = $correspondencia->paquetes -1) : $correspondencia->paquetes = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar paquetes', $json);
                    break;
                default:
                    $status = false;
                    break;
            }
            return response()->json(['status' => $status, 'message' => 'Entregado'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['status' => $status, 'message' => $th->getMessage()], 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }

    public function reiniciarCorrespondencia(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $status = true;
        
        try {
            $correspondencia = Correspondencia::find($request->input('id'));
            $correspondencia->luz = 0;
            $correspondencia->agua = 0;
            $correspondencia->gas = 0;
            $correspondencia->mensajes = 0;
            $correspondencia->paquetes = 0;
            $correspondencia->save();
            return response()->json(['status' => $status, 'message' => 'Correspondencia Reiniciada'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['status' => $status, 'message' => $th->getMessage()], 500, $header, JSON_UNESCAPED_UNICODE);
        }
        
    }

    public function listarCorrespondencia(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $correspondencias = [];
        try {    
            $apartamentos = Residente::where('usuario_id', $request->input('usuario_id') )->get();
            
            foreach ($apartamentos as $value) {
                $corresp = Correspondencia::where('apartamento_id', $value->apartamento_id )->first();
                $correspondencias[] = [
                    'apartamento' => $corresp->apartamento->nombre,
                    'agua' => $corresp->agua,
                    'gas' => $corresp->gas,
                    'luz' => $corresp->luz,
                    'mensajes' => $corresp->mensajes,
                    'paquetes' => $corresp->paquetes
                ] ;
            }

            return response()->json( $correspondencias, 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage() , 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }

    public function reiniciarAgua(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $status = true;
        
        try {
            $correspondencia_agua = Correspondencia::all();
            foreach ($correspondencia_agua as $agua) {
                $agua->agua = 0;
                $agua->save();
            }
            return response()->json(['status' => $status, 'message' => 'Servicios de Agua Reiniciados'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['status' => $status, 'message' => $th->getMessage()], 500, $header, JSON_UNESCAPED_UNICODE);
        }
        
    }

    public function recepcionServiciosConjuntos(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $status = true;
        
        try {
            switch ( $request->input('item') ) {
                case 'Luz':
                    $correspondencia = Correspondencia::all();
                    foreach ($correspondencia as  $value) {
                        $value->luz = $value->luz + 1;
                        $value->save();
                    }
                    log_evento('Correspondencia Recepcion Luz', $request->all());
                    break;
                case 'Agua':
                    $correspondencia = Correspondencia::all();
                    foreach ($correspondencia as  $value) {
                        $value->agua = $value->agua + 1;
                        $value->save();
                    }
                    log_evento('Correspondencia Recepcion Agua', $request->all());;;
                    break;
                case 'Gas':
                    $correspondencia = Correspondencia::all();
                    foreach ($correspondencia as  $value) {
                        $value->gas = $value->gas + 1;
                        $value->save();
                    }
                    log_evento('Correspondencia Recepcion Gas', $request->all());
                    break;
                default:
                    $status = false;
                    break;
            }
            return response()->json(['status' => $status, 'message' => 'Facturas de '.$request->input('item').' agregadas'], 200, $header);
        } catch (\Throwable $th) {
            return response()->json(['status' => $status, 'message' => $th->getMessage()], 500, $header);
        }

    }

    public function correspondenciaApartamento($id)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $correspondencias = [];
        try {    
                $corresp = Correspondencia::where('casa_id', $id )->first();
                $correspondencias = [
                    'id' => $corresp->id,
                    'apartamento' => $corresp->apartamento->nombre,
                    'agua' => $corresp->agua,
                    'gas' => $corresp->gas,
                    'luz' => $corresp->luz,
                    'mensajes' => $corresp->mensajes,
                    'paquetes' => $corresp->paquetes
                ];

            return response()->json( $correspondencias, 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage() , 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }


}

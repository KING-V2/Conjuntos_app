<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorrespondenciaRequest;
use App\Http\Requests\UpdateCorrespondenciaRequest;
use App\Models\Correspondencia\Correspondencia;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Conjunto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.correspondencia.add');
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
                case 'domiciliario':
                    $correspondencia->domiciliario = $correspondencia->domiciliario +1;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Sumar domiciliario', $json);
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
                case 'domiciliario':
                    $correspondencia->domiciliario > 0 ? ($correspondencia->domiciliario = $correspondencia->domiciliario -1) : $correspondencia->domiciliario = 0;
                    $correspondencia->save();
                    $json = json_encode( $request->all() );
                    log_evento('Correspondencia Restar domiciliario', $json);
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
            $correspondencia->domiciliario = 0;
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
                    'domiciliario' => $corresp->domiciliario,
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

    public function correspondenciaCasa($id_residente)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $correspondencias = [];
        try {    
                $id = Residente::where('usuario_id', $id_residente )->first();
                if ( $id != null ) {
                    $corresp = Correspondencia::where('casa_id', $id->casa_id)->first();
                    $correspondencias = [
                        'casa' => $corresp->casa->nombre,
                        'agua' => $corresp->agua,
                        'gas' => $corresp->gas,
                        'luz' => $corresp->luz,
                        'mensajes' => $corresp->mensajes,
                        'domiciliario' => $corresp->domiciliario,
                        'paquetes' => $corresp->paquetes
                    ];
                }else{
                    $correspondencias = [
                        'casa' => 0,
                        'agua' => 0,
                        'gas' => 0,
                        'luz' => 0,
                        'mensajes' => 0,
                        'domiciliario' => 0,
                        'paquetes' => 0
                    ];
                }

            return response()->json( $correspondencias, 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage() , 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }

    public function correspondenciallenar($cantidad)
    {
        for ($i=1; $i < $cantidad; $i++) { 
            $correspondencia = new Correspondencia();
            $correspondencia->casa_id = $i;
            $correspondencia->luz = 0;
            $correspondencia->agua = 0;
            $correspondencia->gas = 0;
            $correspondencia->mensajes = 0;
            $correspondencia->domiciliario = 0;
            $correspondencia->paquetes = 0;
            $correspondencia->save();
        }
        
    }
    
    public function casasllenar($cantidad)
    {
        for ($i=1; $i < $cantidad; $i++) { 
            $casa = new Casas();
            $casa->id        = $i;
            $casa->nombre        = 'Casa '.$i;
            $casa->codigo        = '0000';
            $casa->conjunto_id   = Conjunto::first()->id;       
            $casa->save();
        }
        
    }
    

    public function listar(Request $request)
    {
         if ($request->ajax()) {

            $query = Correspondencia::with(['casa'])->select('correspondencias.*');

            return DataTables::eloquent($query)

                ->addColumn('casa', fn($row) => $row->casa ? $row->casa->nombre : '')
                ->addColumn('luz', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-luz">'.$row->luz.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'luz\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'luz\')"></i>
                    ';
                })
                ->addColumn('agua', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-agua">'.$row->agua.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'agua\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'agua\')"></i>
                    ';
                })
                ->addColumn('gas', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-gas">'.$row->gas.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'gas\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'gas\')"></i>
                    ';
                })
                ->addColumn('mensajes', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-mensajes">'.$row->mensajes.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'mensajes\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'mensajes\')"></i>
                    ';
                })
                ->addColumn('paquetes', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-paquetes">'.$row->paquetes.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'paquetes\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'paquetes\')"></i>
                    ';
                })
                ->addColumn('domiciliario', function ($row) {
                    return '
                        <span id="valor-'.$row->id.'-domiciliario">'.$row->domiciliario.'</span><br>
                        <i style="color:green;font-size:20px;" class="fa-solid fa-circle-plus" onclick="sumarElemento('.$row->id.', \'domiciliario\')"></i> |
                        <i style="color:red;font-size:20px;" class="fa-solid fa-circle-minus" onclick="restarElemento('.$row->id.', \'domiciliario\')"></i>
                    ';
                })
                ->addColumn('reiniciar', function ($row) {
                    return '
                        <i style="color:red;font-size:25px;" class="fa-solid fa-trash" onclick="reiniciarElemento('.$row->id.')"></i>
                    ';
                })

                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value']) {
                        $query->where(function ($q) use ($search) {
                            $q->where('correspondencias.id', 'LIKE', "%{$search}%")
                              ->orWhereHas('casa', fn($sub) => $sub->where('nombre', 'LIKE', "%{$search}%"))
                              ->orWhere('luz', 'LIKE', "%{$search}%")
                              ->orWhere('agua', 'LIKE', "%{$search}%")
                              ->orWhere('gas', 'LIKE', "%{$search}%")
                              ->orWhere('mensajes', 'LIKE', "%{$search}%")
                              ->orWhere('paquetes', 'LIKE', "%{$search}%")
                              ->orWhere('domiciliario', 'LIKE', "%{$search}%");
                        });
                    }
                })

                ->rawColumns(['luz', 'agua', 'gas', 'mensajes', 'paquetes', 'domiciliario', 'reiniciar'])
                ->make(true);
        }

        abort(404);
    }


}

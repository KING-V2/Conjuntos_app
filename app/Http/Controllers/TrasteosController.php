<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrasteosRequest;
use App\Http\Requests\UpdateTrasteosRequest;
use App\Models\Trasteos\Trasteos;
use App\Models\User;
use App\Models\Administracion\Residente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\InformacionConjunto;
use App\Mail\RespuestaTrasteoMail;
use Illuminate\Support\Facades\Mail;


class TrasteosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $obj_trasteos = Trasteos::all();
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
    // Inicializar arreglo con todos los meses vacíos
    $trasteosPorMes = [];
    foreach ($meses as $mes) {
        $trasteosPorMes[$mes] = [];
    }

    // Procesar registros de trasteos
    foreach ($obj_trasteos as $value) {
        $residente = Residente::where('usuario_id', $value->usuario->id)->first();
        $mesNombre = $value->mes ?? '-';

        $trasteosPorMes[$mesNombre][] = [
            'id' => $value->id,
            'solicitante' => $value->usuario->name,
            'apartamento' => $residente->apartamento->nombre ?? 'N/A',
            'bloque' => $residente->bloque->nombre ?? 'N/A',
            'mes' => $mesNombre,
            'fecha' => $value->fecha,
            'hora' => $value->hora,
            'descripcion' => $value->descripcion,
            'administrador' => $value->administrador->name ?? 'Pendiente',
            'descripcion_respuesta' => $value->descripcion_respuesta ?? 'Pendiente',
            'estado' => $value->estado
        ];
    }

    $usuarios = Residente::all();
    return view('admin.trasteos.add', [
        'trasteosPorMes' => $trasteosPorMes,
        'usuarios' => $usuarios,
        'meses' => $meses
    ]);
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
    public function store(StoreTrasteosRequest $request)
    {
        try {
            $trasteos = new Trasteos();
            $trasteos->usuario_id         = $request->input('usuario_id');
            $trasteos->fecha              = $request->input('fecha');
            $trasteos->mes                = $request->input('mes');
            $trasteos->hora               = $request->input('hora');
            $trasteos->descripcion        = $request->input('descripcion');
            $trasteos->estado             = 'Pendiente';
            $trasteos->save();

            session()->flash('flash_success_message', 'Solicitud Registrada');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('trasteos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trasteos $trasteos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trasteos $trasteos, $id)
    {
        try{
            $trasteos = Trasteos::findOrFail( $id );
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            
            return view('admin.trasteos.edit',
                [
                    'trasteo' => $trasteos,
                    'meses' => $meses
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('trasteos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrasteosRequest $request, Trasteos $trasteos)
    {
        $datos = [];
        try {
            // Asignar valores directamente sin buscar nuevamente el modelo
            $trasteos = Trasteos::findOrFail( $request->input('trasteo_id') );
            $trasteos->administrador_id = auth()->user()->id;
            $trasteos->descripcion_respuesta = $request->input('descripcion_respuesta');
            $trasteos->usuario_id         = $trasteos->usuario_id;
            $trasteos->estado = $request->input('estado');
            $trasteos->fecha = $request->input('fecha');
            $trasteos->hora = $request->input('hora');
            $trasteos->mes = $request->input('mes');
            $trasteos->save();
    
            // Obtener conjunto una sola vez
            $conjunto = Conjunto::first();
            
            $datos = [
                'logo' => asset('storage/iconos').'/'. session('icono'),
                'nombre_conjunto' => $conjunto ? $conjunto->nombre : 'N/A',
                'direccion_conjunto' => $conjunto ? $conjunto->direccion : 'N/A',
                'administrador' => auth()->user()->name,
                'respuesta_admin' => $trasteos->descripcion_respuesta,
                'estado' => $trasteos->estado,
                'residente' => $trasteos->usuario ? $trasteos->usuario->name : 'N/A',
                'fecha' => $trasteos->fecha,
                'hora' => $trasteos->hora
            ];
    
            
            // Verificar que el usuario exista antes de enviar el correo
            if ($trasteos->usuario && $trasteos->usuario->email) {
                $this->enviarRespuestaTrasteo($trasteos->usuario->email, $datos);
            }
    
            session()->flash('flash_success_message', 'actualizado');
            
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
        }
    
        return redirect('trasteos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trasteos $trasteos, $id)
    {
        try {
            $trasteos = Trasteos::find( $id );
            $trasteos->delete();
            session()->flash('flash_success_message', 'eliminado');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }

        return redirect('trasteos');
    }

    public function listaSolicitudesTrasteos(Request $request)
    {
        // Verificación de 'usuario_id'
        $usuarioId = $request->input('usuario_id');
        if (empty($usuarioId)) {
            return response()->json(['error' => 'El ID de usuario es requerido.'], 400);
        }

        try {
            $trasteo = [];
            
            $trasteos = Trasteos::where('usuario_id', $usuarioId)->get();
            
            if ($trasteos->isEmpty()) {
                return response()->json(['mensaje' => 'No hay solicitudes de trasteos disponibles.'], 200);
            }

            foreach ($trasteos as $value) {
                $trasteo[] = [
                    'respuesta_admin' => $value->descripcion_respuesta ?? 'No disponible',
                    'respuesta' => $value->descripcion ?? 'No disponible',
                    'mes' => $value->mes,
                    'fecha' => $value->fecha,
                    'hora' => $value->hora,
                    'estado' => $value->estado
                ];
            }

            return response()->json($trasteo, 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            // Manejo de errores en la consulta
            return response()->json(['error' => 'Error al recuperar las solicitudes: ' . $e->getMessage()], 500);
        }
    }



    public function solicitarTrasteo(Request $request)
    {
        try {
            // Validar los campos necesarios
            $request->validate([
                'usuario_id' => 'required',
                'descripcion' => 'required',
                'mes' => 'required',
                'fecha' => 'required|date_format:Y-m-d',
                'hora' => 'required|date_format:H:i:s',
            ]);

            if ($request->input('usuario_id')) {
                $trasteo = new Trasteos();
                $trasteo->usuario_id = $request->input('usuario_id');
                $trasteo->descripcion = $request->input('descripcion');
                $trasteo->mes = $request->input('mes');
                $trasteo->fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'));
                $trasteo->hora = Carbon::createFromFormat('H:i:s', $request->input('hora'));
                $trasteo->estado = 'Pendiente';
                $trasteo->save();

                return response()->json(['message' => 'Solicitud Enviada'], 200);
            } else {
                return response()->json(['error' => 'Usuario no registrado'], 500);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function enviarRespuestaReasteo($email, $datos)
    {
        Mail::send('admin.email_template.respuesta_trasteo_admin', $datos, function($message) use ($email) {
            $message->to($email)
                    ->subject('Respuesta a tu Solicitud de Trasteo');
        });
    }
    public function enviarRespuestaTrasteo($email, $datos)
    {
        try {
            // Mail::to($email)->send(new RespuestaTrasteoMail($datos));
            Mail::send('admin.email_template.respuesta_trasteo_admin', $datos, function($message) use ($email) {
                $message->to($email)->subject('Respuesta solicitud de trasteo');
            });
            session()->flash('flash_success_message', 'email enviado');
            
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
        }
    }
}

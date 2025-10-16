<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRespuestaForoRequest;
use App\Http\Requests\UpdateRespuestaForoRequest;
use App\Models\Encuestas\RespuestaForo;
use App\Models\Administracion\Residente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class RespuestaForoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar las relaciones necesarias, incluyendo apartamento, tipo_residente y bloque desde el usuario
        $obj_respuesta_foros = RespuestaForo::all();
        $respuesta_foros = [];

        foreach ($obj_respuesta_foros as $value) {
            $residente = Residente::where('usuario_id', $value->usuario->id)->first();
            $respuesta_foros[] = [
                'id'                    => $value->id,
                'mes'                   => $value->mes,
                'titulo'                => $value->foro->titulo,
                'descripcion'           => $value->descripcion,
                'descripcion_admin'     => $value->descripcion_admin,
                'fecha_respuesta_admin' => ($value->updated_at ? $value->updated_at->format('Y-m-d') : 'Pendiente'),
                'usuario'               => $value->usuario->name,
                'casa'                  => $residente ? $residente->casas->nombre : 'No Asignado',
                'tipo_residente'        => $residente ? $residente->tipo_residente : 'No Asignado'
            ];
            
        }
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        return view('admin.respuesta_foros.add', [
            'respuesta_foros' => $respuesta_foros,
            'meses' => $meses,
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
    public function store(StoreRespuestaForoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RespuestaForo $respuestaForo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RespuestaForo $respuestaForo, $id)
    {
        try {
            $foro = RespuestaForo::findOrfail($id);
            return view('admin.respuesta_foros.edit',
                [
                    'respuesta_foro' => $foro,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect('respuesta_foros');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRespuestaForoRequest $request, RespuestaForo $respuestaForo)
    {
        try {
            $foro = RespuestaForo::findOrfail($request->input('respuesta_foro_id'));
            $foro->descripcion_admin  = $request->input('descripcion_admin');
            $foro->save();

            $datos = [
                'logo' => asset('storage/iconos').'/'. session('icono'), // Asegúrate de almacenar el logo en "public/storage"
                'contenido_pqr' => $foro->descripcion,
                'respuesta' => $foro->descripcion_admin,
                'administrador' => auth()->user()->name,
                'fecha_respuesta' => now()->format('d/m/Y H:i'),
            ];
            
            session()->flash('flash_success_message', 'Respuesta enviada con éxito');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('respuesta_foros');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RespuestaForo $respuestaForo)
    {
        //
    }

    public function respuestaForo(Request $request)
    {
        try {
            if ($request->input('usuario_id')) {
                Carbon::setLocale('es');
                $respuesta_foro = new RespuestaForo();
                $respuesta_foro->descripcion = $request->input('descripcion');
                $respuesta_foro->foro_id = $request->input('foro_id');
                $respuesta_foro->usuario_id = $request->input('usuario_id');
                $respuesta_foro->mes = ucfirst(Carbon::now()->translatedFormat('F')); // Obtiene el nombre del mes en español

                $respuesta_foro->save();

                return response()->json('Agradecemos tu opinión!! Feliz Día', 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
            } else {
                return response()->json('Usuario no registrado', 500, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
        }
    }

    public function misRespuestasForo(Request $request)
    {
        $respuestas = [];
        try {
            $respuesta_foro = RespuestaForo::where('usuario_id',$request->input('usuario_id'))->get();
            foreach ($respuesta_foro as $value) {
                $respuestas[] = [
                    'foro' => $value->foro->titulo,
                    'fecha_respuesta_admin' => $value->updated_at->format('Y-m-d'),
                    'descripcion' => $value->descripcion,
                    'descripcion_admin' => $value->descripcion_admin ? $value->descripcion_admin : 'Pendiente Respuesta',
                ];
            }
            
            return response()->json($respuestas, 200, ['Content-Type' => 'application/json','charset' => 'utf-8']);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage(), 500, ['Content-Type' => 'application/json','charset' => 'utf-8']);
        }
    }

    // public function enviarRespuestaPQR($email, $datos)
    // {
    //     Mail::send('admin.email_template.respuesta_foro_admin', $datos, function($message) use ($email) {
    //         $message->to($email)
    //                 ->subject('Respuesta a tu PQR');
    //     });
    // }
}

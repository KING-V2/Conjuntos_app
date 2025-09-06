<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncuestasRespuestasRequest;
use App\Http\Requests\UpdateEncuestasRespuestasRequest;
use App\Models\Encuestas\EncuestasRespuestas;
use App\Models\Encuestas\Encuestas;
use App\Models\Administracion\Residente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EncuestasRespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encuestas_respuestas = EncuestasRespuestas::all();
        return view('admin.encuestas_respuestas.add',
            [
                'encuestas_respuestas' => $encuestas_respuestas
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
    public function store(StoreEncuestasRespuestasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EncuestasRespuestas $encuestasRespuestas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EncuestasRespuestas $encuestasRespuestas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEncuestasRespuestasRequest $request, EncuestasRespuestas $encuestasRespuestas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EncuestasRespuestas $encuestasRespuestas)
    {
        //
    }

    public function respuestaEncuesta(Request $request)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        try {
            $encuesta = new EncuestasRespuestas();
            $encuesta->respuesta        = $request->input('respuesta');
            $encuesta->encuesta_id      = $request->input('encuesta_id');
            $encuesta->usuario_id       = $request->input('usuario_id');
            $encuesta->save();
            return response()->json('Agradecemos tu opinion!! Feliz Dia', 200, $header);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage(), 500, $header);
        }
    }

    public function validarRespuestaEncuesta($encuesta_id,$usuario_id)
    {
        $encuesta = EncuestasRespuestas::where( 'usuario_id',$usuario_id )
                                        ->where('encuesta_id', $encuesta_id )
                                        ->get();
        return $encuesta;
    }

    public function validarRespuestaEncuestaUsuario($encuesta_id,$usuario_id)
    {
        $encuesta = EncuestasRespuestas::where( 'usuario_id',$usuario_id )
                                        ->where('encuesta_id', $encuesta_id )
                                        ->get();
        return $encuesta->isEmpty();
    }

    public function getEncuestaUsuario($usuario_id)
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
        // obtencion de encuestas del mes
        $encuestas_mes = Encuestas::where('mes',$nombreMesEnEspanol)->get();
        $residente      = Residente::where('usuario_id',$usuario_id)->first();
        $encuestas_disponibles = [];
        // se recorren las encuestas para buscar la coincidencia entre las encuestas del mes y las respuestas de encuestas del ususario
        foreach ($encuestas_mes as $value) 
        {
            $puede_votar = $this->validarRespuestaEncuestaUsuario($value->id,$usuario_id);
            $encuestas_existentes = $this->validarRespuestaEncuesta($value->id,$usuario_id);
            if( $encuestas_existentes->isEmpty() && ( ($value->tipo_residente == $residente->tipo_residente) || ($value->tipo_residente == 'Ambos') ) )
            {
                $encuesta = Encuestas::find($value->id);
                $encuestas_disponibles[] = [
                    'id' => $encuesta->id,
                    'mes' => $encuesta->mes,
                    'estado' => $encuesta->estado,
                    'descripcion' => $encuesta->descripcion,
                    'opciones' => $encuesta->opciones,
                    'tipo_residente' => $encuesta->tipo_residente,
                    'created_at' => $encuesta->created_at,
                    'updated_at' => $encuesta->updated_at,
                    'puede_votar' => $puede_votar
                ];
            }
        }
        return response()->json( $encuestas_disponibles , 200, $header);
    }

    public function consultarEncuestasActivas($usuario_id)
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
        // obtencion de encuestas del mes
        $encuestas_mes = Encuestas::where('mes',$nombreMesEnEspanol)->get();
        $residente      = Residente::where('usuario_id',$usuario_id)->first();
        $encuestas_disponibles = [];

        // se recorren las encuestas para buscar la coincidencia entre las encuestas del mes y las respuestas de encuestas del ususario
        foreach ($encuestas_mes as $value) 
        {
            $puede_votar = $this->validarRespuestaEncuestaUsuario($value->id,$usuario_id);
            if( ( $value->tipo_residente == $residente->tipo_residente ) || ( $value->tipo_residente == 'Ambos') )
            {
                
                $encuesta = Encuestas::find($value->id);
                $encuestas_disponibles[] = [
                    'id' => $encuesta->id,
                    'mes' => $encuesta->mes,
                    'estado' => $encuesta->estado,
                    'descripcion' => $encuesta->descripcion,
                    'opciones' => $encuesta->opciones,
                    'tipo_residente' => $encuesta->tipo_residente,
                    'created_at' => $encuesta->created_at,
                    'updated_at' => $encuesta->updated_at,
                    'puede_votar' => $puede_votar
                ];
            }
        }
        return response()->json( $encuestas_disponibles , 200, ['Content-Type' => 'application/json','charset' => 'utf-8']);
    }

    public function estadisticaEncuestas($encuesta_id)
    {
        $estadistica = [];
        // Obtener estadísticas de las respuestas de la encuesta con el ID proporcionado
        try {
            $estadistica = DB::table('encuestas_respuestas')
                                ->select(DB::raw('DISTINCT respuesta'), DB::raw('COUNT(respuesta) AS total_respuestas'))
                                ->where('encuesta_id', $encuesta_id)
                                ->groupBy('respuesta')
                                ->orderBy('total_respuestas', 'desc')
                                ->get();

            return response()->json( $estadistica , 200, ['Content-Type' => 'application/json','charset' => 'utf-8']);
        } catch (\Throwable $th) {
            $estadistica = [
                'statusCode' => 500,
                'error' => $th->getMesssage() 
            ];
            return response()->json( $estadistica , 500, ['Content-Type' => 'application/json','charset' => 'utf-8']);
        }
    }

    public function estadisticaEncuestasWeb($encuesta_id)
    {
        try {
            // Obtener la encuesta y sus estadísticas
            $encuesta = DB::table('encuestas')
                ->select('descripcion', 'created_at')
                ->where('id', $encuesta_id)
                ->first();

            if (!$encuesta) {
                return response()->json([
                    'statusCode' => 404,
                    'error' => 'Encuesta no encontrada'
                ], 404, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
            }

            $estadistica = DB::table('encuestas_respuestas')
                ->select('respuesta', DB::raw('COUNT(respuesta) AS total_respuestas'))
                ->where('encuesta_id', $encuesta_id)
                ->groupBy('respuesta')
                ->orderBy('total_respuestas', 'desc')
                ->get();

            // Formatear los datos según el formato esperado
            $respuestas = $estadistica->map(function ($item) {
                return [
                    'respuesta' => (string) $item->respuesta,
                    'total_respuestas' => (int) $item->total_respuestas,
                ];
            });

            // Estructura final de la respuesta
            $resultado = [
                'titulo' => $encuesta->descripcion,
                'fecha_creacion' => Carbon::parse($encuesta->created_at)->format('Y-m-d'), // Formato de fecha
                'respuestas' => $respuestas
            ];

            return response()->json($resultado, 200, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
        } catch (\Throwable $th) {
            return response()->json([
                'statusCode' => 500,
                'error' => $th->getMessage()
            ], 500, ['Content-Type' => 'application/json', 'charset' => 'utf-8']);
        }
    }

}
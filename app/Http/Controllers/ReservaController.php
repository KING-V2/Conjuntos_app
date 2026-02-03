<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Reservas\Reserva;
use App\Models\Reservas\ZonaComun;
use App\Models\Administracion\Conjunto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class ReservaController extends Controller
{
    public function index()
    {
        $zonas = ZonaComun::where('estado', 'Activo')->get();
        $zonas_h = ZonaComun::with('horarios')->get();

        $reglasPorZona = [];

        foreach ($zonas_h as $zona) {
            $reglasPorZona[$zona->id] = [
                'semana' => [],
                'finde'  => [],
            ];

            foreach ($zona->horarios as $horario) {
                $reglasPorZona[$zona->id][$horario->tipo_dia][] = [
                    'from' => substr($horario->hora_inicio, 0, 5),
                    'to'   => substr($horario->hora_fin, 0, 5),
                ];
            }
        }

        return view('admin.reservas.index', compact('zonas', 'reglasPorZona'));
    }
    
    public function reservas()
    {
        $meses = explode(',', env('MESES'));
        return view('reservas.index_admin', compact('meses'));
    }
    
    public function store(Request $request)
    {
        date_default_timezone_set('America/Bogota');
        Carbon::setLocale('es');

        $conjunto = Conjunto::find(session('conjunto_id'));

        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'identificacion'  => 'required|string|max:100',
            'interior'        => 'required|string|max:100',
            'apartamento'     => 'required|string|max:100',
            'email'           => 'required|email|max:255',
            'celular'         => 'required|string|max:100',
            'tipo_residente'  => 'required|string|max:100',
            'zona_id'         => 'required|exists:zonas,id',
            'fecha'           => 'required|date_format:Y-m-d',
            'hora'            => 'required|exists:zonas_horarios,id',
            'personas'        => 'nullable|integer|min:1'
        ]);

        $zona = ZonaComun::findOrFail($request->zona_id);
        $horario = ZonaHorario::where('id', $request->hora)->first();

        if (!$horario) {
            return response()->json([
                'message' => 'Horario inválido para la zona seleccionada.'
            ], 422);
        }

        try {
            $horaInicio24 = Carbon::parse($horario->hora_inicio)->format('H:i');
            $horaFin24    = Carbon::parse($horario->hora_fin)->format('H:i');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Horario mal configurado en la base de datos.'
            ], 422);
        }

        /* =========================
        CONSTRUIR FECHAS (FIX)
        ========================= */
        $inicio = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->fecha . ' ' . $horaInicio24
        );

        $fin = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->fecha . ' ' . $horaFin24
        );

        $ocupadas = Reserva::query()
        ->join('zonas_comunes as z', 'z.id', '=', 'reservas.zona_id')
        ->join('zonas_horarios as zh', 'zh.zona_id', '=', 'z.id')
        ->where('z.id', $zona->id)
        ->where('zh.id', $horario->id)
        ->where('reservas.inicio', $request->fecha.' '.$horario->hora_inicio)
        ->where('reservas.fin', $request->fecha.' '.$horario->hora_fin)
        ->selectRaw('COALESCE(SUM(reservas.id), 0) as total_personas')
        ->count();

        if ($ocupadas >= $zona->limite) {
            return response()->json([
                'message' => 'No hay cupos disponibles para esta hora.'
            ], 422);
        }

        $reserva = Reserva::create([
            'nombre_completo' => $request->nombre_completo,
            'identificacion'  => $request->identificacion,
            'interior'        => $request->interior,
            'apartamento'     => $request->apartamento,
            'email'           => $request->email,
            'celular'         => $request->celular,
            'conjunto_id'     => $conjunto->id,
            'tipo_residente'  => $request->tipo_residente,
            'zona_id'         => $zona->id,
            'horario_id'      => $horario->id,
            'inicio'          => $inicio,
            'fin'             => $fin,
            'fecha'           => $request->fecha,
            'estado'          => 'aprobada',
            'mes'             => $inicio->translatedFormat('F'),
            'asistencia'      => 'Pendiente',
        ]);

        $correo_reserva = [
            'nombre' => $request->nombre_completo,
            'email'  => $request->email,
            'interior'  => $request->interior,
            'apartamento'  => $request->apartamento,
            'conjunto'    => $conjunto->nombre,
            'fecha_solicitud'    => $reserva->created_at->format('Y-m-d H:i:s'),
            'zona'        => $zona->nombre,
            'fecha'     => $request->fecha,
            'hora'     => $horario->hora_inicio,
        ];

        Mail::to( $request->email )->send(new ConfirmacionReserva($correo_reserva));

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $reserva->id,
                'zona' => $zona->nombre,
                'fecha' => $request->fecha,
                'hora' => $horario->hora_inicio,
                'personas' => $ocupadas +1 ?? 0,
                'created_at' => $reserva->created_at->format('Y-m-d H:i:s'),
            ],
            'message' => 'Reserva registrada correctamente'
        ]);
    }
    
    public function store_mobile(Request $request)
    {
        date_default_timezone_set('America/Bogota');
        Carbon::setLocale('es');

        $conjunto = Conjunto::find(session('conjunto_id'));

        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'identificacion'  => 'required|string|max:100',
            'interior'        => 'required|string|max:100',
            'apartamento'     => 'required|string|max:100',
            'email'           => 'required|email|max:255',
            'celular'         => 'required|string|max:100',
            'tipo_residente'  => 'required|string|max:100',
            'zona_id'         => 'required|exists:zonas,id',
            'fecha'           => 'required|date_format:Y-m-d',
            'hora'            => 'required|exists:zonas_horarios,id',
            'personas'        => 'nullable|integer|min:1'
        ]);

        $zona = ZonaComun::findOrFail($request->zona_id);
        $horario = ZonaHorario::where('id', $request->hora)->first();

        if (!$horario) {
            return response()->json([
                'message' => 'Horario inválido para la zona seleccionada.'
            ], 422);
        }

        try {
            $horaInicio24 = Carbon::parse($horario->hora_inicio)->format('H:i');
            $horaFin24    = Carbon::parse($horario->hora_fin)->format('H:i');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Horario mal configurado en la base de datos.'
            ], 422);
        }

        /* =========================
        CONSTRUIR FECHAS (FIX)
        ========================= */
        $inicio = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->fecha . ' ' . $horaInicio24
        );

        $fin = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->fecha . ' ' . $horaFin24
        );

        $ocupadas = Reserva::query()
        ->join('zonas_comunes as z', 'z.id', '=', 'reservas.zona_id')
        ->join('zonas_horarios as zh', 'zh.zona_id', '=', 'z.id')
        ->where('z.id', $zona->id)
        ->where('zh.id', $horario->id)
        ->where('reservas.inicio', $request->fecha.' '.$horario->hora_inicio)
        ->where('reservas.fin', $request->fecha.' '.$horario->hora_fin)
        ->selectRaw('COALESCE(SUM(reservas.id), 0) as total_personas')
        ->count();

        if ($ocupadas >= $zona->limite) {
            return response()->json([
                'message' => 'No hay cupos disponibles para esta hora.'
            ], 422);
        }

        $reserva = Reserva::create([
            'nombre_completo' => $request->nombre_completo,
            'identificacion'  => $request->identificacion,
            'interior'        => $request->interior,
            'apartamento'     => $request->apartamento,
            'email'           => $request->email,
            'celular'         => $request->celular,
            'conjunto_id'     => $conjunto->id,
            'tipo_residente'  => $request->tipo_residente,
            'zona_id'         => $zona->id,
            'horario_id'      => $horario->id,
            'inicio'          => $inicio,
            'fin'             => $fin,
            'fecha'           => $request->fecha,
            'estado'          => 'aprobada',
            'mes'             => $inicio->translatedFormat('F'),
            'asistencia'      => 'Pendiente',
        ]);

        $correo_reserva = [
            'nombre' => $request->nombre_completo,
            'email'  => $request->email,
            'interior'  => $request->interior,
            'apartamento'  => $request->apartamento,
            'conjunto'    => $conjunto->nombre,
            'fecha_solicitud'    => $reserva->created_at->format('Y-m-d H:i:s'),
            'zona'        => $zona->nombre,
            'fecha'     => $request->fecha,
            'hora'     => $horario->hora_inicio,
        ];

        Mail::to( $request->email )->send(new ConfirmacionReserva($correo_reserva));

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $reserva->id,
                'zona' => $zona->nombre,
                'fecha' => $request->fecha,
                'hora' => $horario->hora_inicio,
                'personas' => $ocupadas +1 ?? 0,
                'created_at' => $reserva->created_at->format('Y-m-d H:i:s'),
            ],
            'message' => 'Reserva registrada correctamente'
        ]);
    }


    public function asistencia($id, Request $request)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->asistencia = $request->asistencia; // "ASISTIÓ" o "NO ASISTIÓ"
        $reserva->save();

        return response()->json(['message' => 'Asistencia actualizada correctamente']);
    }

    // ALTER TABLE `reservas` ADD `asistencia` VARCHAR(100) NULL AFTER `estado`;
    // ALTER TABLE `reservas` ADD `mes` VARCHAR(100) NULL AFTER `estado`;

    public function list(Request $request)
    {
        $mes = $request->mes;

        // 1. Consultar reservas filtrando por mes + cargar relaciones
        $reservas = Reserva::with(['conjunto', 'zona'])
            ->where('mes', '=', $mes)
            ->get()
            ->map(function($r){
                return [
                    'id'              => $r->id,
                    'nombre_completo' => $r->nombre_completo,
                    'identificacion'  => $r->identificacion,
                    'email'           => $r->email,
                    'celular'         => $r->celular,
                    'interior'        => $r->interior,
                    'apartamento'     => $r->apartamento,
                    'conjunto'        => $r->conjunto?->nombre,
                    'zona'            => $r->zona?->nombre,
                    'tipo_residente'  => $r->tipo_residente,
                    'inicio'          => $r->inicio,
                    'fin'             => $r->fin,
                    'estado'          => $r->estado,
                    'asistencia'      => $r->asistencia ?? 'Pendiente',
                ];
            });

        // 2. Retornar DataTable compatible con tu vista
        return DataTables::of($reservas)->make(true);
    }

    private function mesNumero($mes)
    {
        return [
            'ENERO'=>1,'FEBRERO'=>2,'MARZO'=>3,'ABRIL'=>4,'MAYO'=>5,'JUNIO'=>6,
            'JULIO'=>7,'AGOSTO'=>8,'SEPTIEMBRE'=>9,'OCTUBRE'=>10,'NOVIEMBRE'=>11,'DICIEMBRE'=>12
        ][strtoupper($mes)];
    }

    public function exportCsv($mes)
    {
        $reservas = Reserva::with(['conjunto', 'zona'])
            ->where('mes', $mes)
            ->get();

        $fileName = "reservas_{$mes}.csv";

        return response()->streamDownload(function () use ($reservas) {

            $handle = fopen('php://output', 'w');

            // 👇 Encabezados del CSV
            fputcsv($handle, [
                'ID',
                'Nombre',
                'Identificación',
                'Email',
                'Celular',
                'Conjunto',
                'Interior',
                'Apartamento',
                'Zona',
                'Tipo residente',
                'Inicio',
                'Fin',
                'Estado',
                'Asistencia'
            ], ';'); // separador ; (mejor para Excel ES)

            // 👇 Filas
            foreach ($reservas as $r) {
                fputcsv($handle, [
                    $r->id ?? '-',
                    $r->nombre_completo ?? '-',
                    $r->identificacion ?? '-',
                    $r->email ?? '-',
                    $r->celular ?? '-',
                    $r->conjunto?->nombre ?? '-',
                    $r->interior ?? '-',
                    $r->apartamento ?? '-',
                    $r->zona?->nombre ?? '-',
                    $r->tipo_residente ?? '-',
                    $r->inicio ?? '-',
                    $r->fin ?? '-',
                    $r->estado ?? '-',
                    $r->asistencia ?? 'Pendiente',
                ], ';');
            }

            fclose($handle);

        }, $fileName, [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$fileName}",
        ]);
    }
   
    public function mis_reservas($id)
    {
        $usuarioId = $id;

        if (!$usuarioId) {
            return response()->json([
                'message' => 'El usuario es obligatorio.'
            ], 400);
        }

        $reservas = Reserva::with('zona_comun')
            ->where('usuario_id', $usuarioId)
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function ($reserva) {
                return [
                    'fecha' => $reserva->fecha,
                    'hora_inicio' => $reserva->hora_inicio,
                    'hora_fin' => $reserva->hora_fin,
                    'estado' => $reserva->estado,
                    'zona_comun_nombre' => $reserva->zona_comun->nombre ?? null,
                ];
            });

        return response()->json($reservas);
    }

    public function cargarComprobante(Request $request )
    {
        try {
            $id_reserva = $request->input('id_reserva');
            $reserva = Reserva::find($id_reserva);
            if( $request->file('comprobante_pago') )
            {
                $pdf                = $request->file('comprobante_pago');
                $file_name          = 'file_'.$fecha.'.'.$pdf->getClientOriginalExtension();
                $reserva->comprobante_pago        = $file_name;
                Storage::disk('storage_pagos')->put($file_name , file_get_contents($pdf) );
            }

            $json = json_encode( $request->all() );
            log_evento('Cargue Pago Reserva', $json);
            
            $reserva->save();
            session()->flash('flash_success_message', 'actualizado correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
    }



}

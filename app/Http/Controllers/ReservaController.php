<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Reservas\Reserva;
use App\Models\Reservas\ZonaComun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class ReservaController extends Controller
{
    
    // Admin: lista todas las reservas
    public function index()
    {
        $reservas = Reserva::with(['zona_comun','usuario','administrador'])->orderByDesc('fecha')->paginate(20);
        return view('admin.reservas.index', compact('reservas'));
    }

    // Usuario: formulario para crear reserva
    public function create()
    {
        $zonas = ZonaComun::where('activo', true)->orderBy('nombre')->get();
        return view('admin.reservas.create', compact('zonas'));
    }

    // Store desde formulario (o API si se adapta)
    public function store(Request $request)
    {
        $request->validate([
            'zona_comun_id' => 'required|exists:zona_comun,id',
            'fecha' => 'required|date_format:Y-m-d',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'nullable|string',
            'comprobante' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240'
        ]);

        // validar horario definido
        $diaSemana = date('w', strtotime($request->fecha)); // 0..6
        $horarioValido = ZonaComunHorario::where('zona_comun_id', $request->zona_comun_id)
            ->where('dia_semana', $diaSemana)
            ->where('hora_inicio', '<=', $request->hora_inicio)
            ->where('hora_fin', '>=', $request->hora_fin)
            ->exists();

        if (!$horarioValido) {
            return back()->withErrors(['error' => 'Horario no disponible para la fecha/hora seleccionada.'])->withInput();
        }

        // chequear conflicto con reservas ya aprobadas
        $conflicto = Reserva::where('zona_comun_id', $request->zona_comun_id)
            ->where('fecha', $request->fecha)
            ->where(function($q) use ($request) {
                $q->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function($qq) use ($request) {
                      $qq->where('hora_inicio', '<=', $request->hora_inicio)
                         ->where('hora_fin', '>=', $request->hora_fin);
                  });
            })
            ->where('estado', 'Aprobado')
            ->exists();

        if ($conflicto) {
            return back()->withErrors(['error' => 'Existe una reserva aprobada que cruza este horario.'])->withInput();
        }

        DB::beginTransaction();
        try {
            $path = null;
            if ($request->hasFile('comprobante')) {
                $path = $request->file('comprobante')->store('comprobantes', 'public');
            }

            $reserva = Reserva::create([
                'usuario_id' => Auth::id(),
                'zona_comun_id' => $request->zona_comun_id,
                'fecha' => $request->fecha,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'descripcion' => $request->descripcion,
                'comprobante_pago' => $path,
                'estado' => 'Pendiente'
            ]);

            DB::commit();
            return redirect()->route('reservas.index')->with('success','Reserva creada y pendiente de aprobación.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear reserva: '.$e->getMessage()])->withInput();
        }
    }

    // Aprobar (admin)
    public function aprobar(Request $request, $id)
    {
        $request->validate(['descripcion_respuesta' => 'nullable|string']);

        $reserva = Reserva::findOrFail($id);

        // volver a verificar conflictos antes de aprobar
        $conflicto = Reserva::where('zona_comun_id', $reserva->zona_comun_id)
            ->where('fecha', $reserva->fecha)
            ->where(function($q) use ($reserva) {
                $q->whereBetween('hora_inicio', [$reserva->hora_inicio, $reserva->hora_fin])
                  ->orWhereBetween('hora_fin', [$reserva->hora_inicio, $reserva->hora_fin])
                  ->orWhere(function($qq) use ($reserva) {
                      $qq->where('hora_inicio', '<=', $reserva->hora_inicio)
                         ->where('hora_fin', '>=', $reserva->hora_fin);
                  });
            })
            ->where('estado', 'Aprobado')
            ->exists();

        if ($conflicto) {
            return back()->withErrors(['error' => 'No se puede aprobar: conflicto con otra reserva aprobada.']);
        }

        $reserva->estado = 'Aprobado';
        $reserva->descripcion_respuesta = 'Aprobada';
        $reserva->administrador_id = Auth::id();
        $reserva->save();

        return back()->with('success','Reserva aprobada.');
    }

    // Rechazar (admin)
    public function rechazar(Request $request, $id)
    {
        $request->validate(['descripcion_respuesta' => 'required|string']);

        $reserva = Reserva::findOrFail($id);
        $reserva->estado = 'Rechazado';
        $reserva->descripcion_respuesta = $request->descripcion_respuesta;
        $reserva->administrador_id = Auth::id();
        $reserva->save();

        return back()->with('success','Reserva rechazada.');
    }

    // Mostrar comprobante (archivo)
    public function mostrarComprobante($id)
    {
        $reserva = Reserva::findOrFail($id);
        if (!$reserva->comprobante_pago) {
            abort(404);
        }
        return response()->file(storage_path('app/public/'.$reserva->comprobante_pago));
    }
    
    public function solicitar_reserva(Request $request)
    {
        $request->estado = 'Pendiente';
        
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'required|string',
            'usuario_id' => 'required|integer',
            'zona_comun_id' => 'required|integer',
            'descripcion' => 'required|string|max:500',
        ]);

        try {
            $reserva = Reserva::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente',
                'data' => $reserva
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la reserva: ' . $e->getMessage(),
            ], 500);
        }
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

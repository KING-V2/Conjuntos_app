<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZonaHorarioRequest;
use App\Http\Requests\UpdateZonaHorarioRequest;
use App\Models\ZonaHorario;
use App\Models\ZonaComun;
use Illuminate\Http\Request;

class ZonaHorarioController extends Controller
{
    /**
     * Guardar un nuevo horario para una zona
     */
    public function store(Request $request)
    {
        $request->validate([
            'zona_id'     => 'required|exists:zona_comun,id',
            'tipo_dia'    => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo,Festivo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin'    => 'required|date_format:H:i|after:hora_inicio',
        ]);

        // Validar que no se crucen horarios
        $existeCruce = ZonaHorario::where('zona_id', $request->zona_id)
            ->where('tipo_dia', $request->tipo_dia)
            ->where(function ($q) use ($request) {
                $q->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('hora_inicio', '<=', $request->hora_inicio)
                         ->where('hora_fin', '>=', $request->hora_fin);
                  });
            })
            ->exists();

        if ($existeCruce) {
            return back()->withErrors('El horario se cruza con uno existente.');
        }

        ZonaHorario::create([
            'zona_id'     => $request->zona_id,
            'tipo_dia'    => $request->tipo_dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin'    => $request->hora_fin,
            'intervalo'   => 60, // puedes hacerlo configurable luego
        ]);

        return back()->with('success', 'Horario agregado correctamente.');
    }

    /**
     * Eliminar un horario
     */
    public function destroy($id)
    {
        $horario = ZonaHorario::findOrFail($id);
        $horario->delete();

        return back()->with('success', 'Horario eliminado correctamente.');
    }

    public function getHorarios($zonaId)
    {
        $horarios = ZonaHorario::where('zona_id', $zonaId)->orderBy('hora_inicio', 'DESC')->get();

        return response()->json($horarios);
    }

    // En tu controlador de reservas o zonas
    public function checkAvailability(Request $request)
    {
        $zonaId = $request->input('zona_id');
        $fecha = $request->input('fecha');
        
        // Convertir la fecha al día de la semana
        $diaSemana = date('N', strtotime($fecha)); // 1=Lunes, 7=Domingo
        $diasMap = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        ];
        $tipoDia = $diasMap[$diaSemana];
        
        // Verificar si es festivo
        $esFestivo = $this->esFestivo($fecha);
        if ($esFestivo) {
            $tipoDia = 'Festivo';
        }
        
        // Obtener horarios configurados para ese día
        $horarios = Horario::where('zona_id', $zonaId)
            ->where('tipo_dia', $tipoDia)
            ->where('activo', true)
            ->orderBy('hora_inicio')
            ->get();
        
        // Verificar reservas existentes para esa fecha
        $reservas = Reserva::where('zona_id', $zonaId)
            ->where('fecha', $fecha)
            ->where('estado', 'confirmada')
            ->get();
        
        $horariosDisponibles = [];
        $zona = Zona::find($zonaId);
        $limite = $zona->limite;
        
        foreach ($horarios as $horario) {
            // Contar reservas para este horario
            $reservasEnHorario = $reservas->filter(function($reserva) use ($horario) {
                return $reserva->hora_inicio == $horario->hora_inicio &&
                    $reserva->hora_fin == $horario->hora_fin;
            });
            
            // Verificar si hay cupo disponible
            if ($reservasEnHorario->count() < $limite) {
                $horariosDisponibles[] = [
                    'id' => $horario->id,
                    'hora_inicio' => $horario->hora_inicio,
                    'hora_fin' => $horario->hora_fin,
                    'disponibles' => $limite - $reservasEnHorario->count()
                ];
            }
        }
        
        return response()->json([
            'success' => true,
            'horarios' => $horariosDisponibles,
            'tipo_dia' => $tipoDia,
            'fecha' => $fecha
        ]);
    }

    public function horariosPorZona($zonaId)
    {
        $horarios = ZonaHorario::where('zona_id', $zonaId)
            ->orderBy('tipo_dia')
            ->orderBy('hora_inicio')
            ->get();

        return response()->json($horarios);
    }


}

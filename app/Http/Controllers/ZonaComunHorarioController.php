<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas\ZonaComunHorario;
use App\Models\Reservas\ZonaComun;

class ZonaComunHorarioController extends Controller
{
    // Mostrar horarios de una zona (list)
    public function index($zona_id)
    {
        $zona = ZonaComun::findOrFail($zona_id);
        $horarios = $zona->horarios()->orderBy('dia_semana')->orderBy('hora_inicio')->get();
        return view('admin.zonas_comunes.horarios', compact('zona','horarios'));
    }

    // Guardar horario para zona
    public function store(Request $request, $zona_id)
    {
        $request->validate([
            'dia_semana' => 'required|integer|min:0|max:6',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);

        $zona = ZonaComun::findOrFail($zona_id);

        ZonaComunHorario::create([
            'zona_comun_id' => $zona->id,
            'dia_semana' => $request->dia_semana,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('zonas.horarios.index', $zona->id)->with('success','Horario agregado.');
    }

    // Eliminar horario
    public function destroy($id)
    {
        $horario = ZonaComunHorario::findOrFail($id);
        $zona_id = $horario->zona_comun_id;
        $horario->delete();
        return redirect()->route('zonas.horarios.index', $zona_id)->with('success','Horario eliminado.');
    }
}

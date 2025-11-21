<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZonaComunRequest;
use App\Http\Requests\UpdateZonaComunRequest;
use App\Models\Reservas\ZonaComun;
use App\Models\Reservas\ZonaComunHorario;
use Illuminate\Http\Request;


class ZonaComunController extends Controller
{
    public function index()
    {
        $zonas = ZonaComun::orderBy('nombre')->paginate(20);
        return view('admin.zonas_comunes.index', compact('zonas'));
    }

    // public function create()
    // {
    //     return view('admin.zonas_comunes.create');
    // }

    public function create()
    {
        $horarios = [];
        return view('admin.zonas_comunes.gestion', compact('horarios'));
    }

    public function edit($id)
    {
        $zona = ZonaComun::findOrFail($id);
        $horarios = $zona->horarios()->orderBy('dia_semana')->orderBy('hora_inicio')->get();

        return view('admin.zonas_comunes.gestion', compact('zona','horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|string'
        ]);

        ZonaComun::create($request->only(['nombre','descripcion','estado','conjunto_id','activo']));

        return redirect()->route('zonas.index')->with('success','Zona común creada.');
    }

    // public function edit($id)
    // {
    //     $zona = ZonaComun::findOrFail($id);
    //     return view('admin.zonas_comunes.create', compact('zona')); // reutilizamos la misma vista para create/edit
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|string'
        ]);

        $zona = ZonaComun::findOrFail($id);
        $zona->update($request->only(['nombre','descripcion','estado','activo']));

        return redirect()->route('zonas.index')->with('success','Zona común actualizada.');
    }

    public function destroy($id)
    {
        $zona = ZonaComun::findOrFail($id);
        $zona->delete();
        return redirect()->route('zonas.index')->with('success','Zona común eliminada.');
    }

    public function getZonasComunes()
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $zonas_comunes = ZonaComun::where('estado', 'Activo')->get();
        return response()->json($zonas_comunes, 200, $header, JSON_UNESCAPED_UNICODE);
    }
}

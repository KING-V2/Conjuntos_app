<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMensajesVistasRequest;
use App\Http\Requests\UpdateMensajesVistasRequest;
use App\Models\MensajesVistas;

class MensajesVistasController extends Controller
{
 public function index()
    {
        $mensajes = MensajesVistas::orderBy('id', 'ASC')->get();
        return view('admin.mensajes_vistas.index', compact('mensajes'));
    }

    public function create()
    {
        return view('admin.mensajes_vistas.create');
    }

    public function store(StoreMensajesVistasRequest $request)
    {

        MensajesVistas::create(
            [
            'mensaje' => $request->mensaje,
            'vista' => $request->vista,
            ]
        );

        return redirect()->route('mensajes_vistas.index')->with('success', 'Mensaje creado correctamente.');
    }

    public function edit($id)
    {
        $mensaje = MensajesVistas::findOrFail($id);
        return view('admin.mensajes_vistas.edit', compact('mensaje'));
    }

    public function update(UpdateMensajesVistasRequest $request, $id)
    {

        $mensaje = MensajesVistas::findOrFail($id);
        $mensaje->update($request->all());

        return redirect()->route('mensajes_vistas.index')->with('success', 'Mensaje actualizado correctamente.');
    }

    public function destroy($id)
    {
        MensajesVistas::findOrFail($id)->delete();

        return redirect()->route('mensajes_vistas.index')->with('success', 'Mensaje eliminado correctamente.');
    }

    public function getMensajeVista($vista)
    {
        try {
            $mensaje = MensajesVistas::where('vista',$vista)->get();
            return response()->json($mensaje, 200, ['Content-Type' => 'application/json; charset=utf-8']);
        } catch (\Throwable $th) {
            if ($vista->isEmpty()) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500, ['Content-Type' => 'application/json; charset=utf-8']);
        }
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformacionConjuntoRequest;
use App\Http\Requests\UpdateInformacionConjuntoRequest;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\InformacionConjunto;

class InformacionConjuntoController extends Controller {
    public function index() {
        $informaciones = InformacionConjunto::all();
        return view('admin.informacion_conjunto.index', compact('informaciones'));
    }

    public function create() {
        return view('admin.informacion_conjunto.create');
    }

    public function store(StoreInformacionConjuntoRequest $request) {    
        try {
            InformacionConjunto::create([
                'conjunto_id'     => Conjunto::first()->id,
                'dias'            => $request->input('dias'),
                'texto_horas'     => $request->input('texto_horas'),
                'texto_adicional' => $request->input('texto_adicional')
            ]);
            return redirect()->route('informacion_conjunto.index')->with('success', 'Información registrada con éxito.');
        }catch (\Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage());
        }
        return back()->withInput();
    }

    public function edit($id) {
        try {
            $informacionConjunto = InformacionConjunto::findOrFail($id);
            return view('admin.informacion_conjunto.edit', compact('informacionConjunto'));
        }catch (\Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage());
        }
        return back()->withInput();
    }

    public function update(UpdateInformacionConjuntoRequest $request, $id) {
        try {
            $informacionConjunto = InformacionConjunto::findOrFail($id);

            $informacionConjunto->update([
                'dias'            => $request->input('dias'),
                'texto_horas'     => $request->input('texto_horas'),
                'texto_adicional' => $request->input('texto_adicional')
            ]);

            session()->flash('flash_success_message', 'Información actualizada con éxito.');
            return redirect()->route('informacion_conjunto.index');

        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id) {
        try {
            $info = InformacionConjunto::findOrFail($id);
            $info->delete();
            session()->flash('flash_success_message', 'Información eliminada con éxito.');
            return redirect()->route('informacion_conjunto.index');
        }catch (\Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage());
        }
        return back()->withInput();
    }

    public function informacion_conjunto()
    {
        $conjunto = Conjunto::with('administrador')->first();
        $horarios = InformacionConjunto::all()->map(function ($info) {
            return [
                'dias'            => $info->dias,
                'texto_horas'     => $info->texto_horas,
                'texto_adicional' => $info->texto_adicional,
            ];
        });

        $info_conjunto = $conjunto ? [
            'direccion' => $conjunto->direccion,
            'nombre'    => $conjunto->nombre,
            'correo'    => $conjunto->administrador?->email ?? 'N/A',
        ] : [];

        return response()->json([
            'info_conjunto'    => $info_conjunto,
            'horarios_conjunto'=> $horarios,
        ]);
    }

}

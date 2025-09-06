<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformacionConjuntoRequest;
use App\Http\Requests\UpdateInformacionConjuntoRequest;
use Illuminate\Http\Request;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\InformacionConjunto;
use App\Models\Administracion\Bloque;
use Illuminate\Support\Facades\Session;
use App\Models\Administracion\Apartamento;
use App\Models\Correspondencia\Correspondencia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



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
                'conjunto_id' => Conjunto::first()->id,
                'dias' => $request->input('dias'),
                'horas' => $request->input('horas'),
                'telefonos' => $request->input('telefonos')
            ]);
            return redirect()->route('informacion_conjunto.index')->with('success', 'Información registrada con éxito.');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    public function edit(InformacionConjunto $informacionConjunto, $id) {
        try {
            $informacionConjunto = InformacionConjunto::findOrFail($id);
            return view('admin.informacion_conjunto.edit', compact('informacionConjunto'));
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    public function update(UpdateInformacionConjuntoRequest $request, InformacionConjunto $informacionConjunto) {
        try {
            // Encontrar la información del conjunto asociada
            $informacionConjunto = InformacionConjunto::first();
    
            // Actualizar los valores
            $informacionConjunto->update($request->all());    
            session()->flash('flash_success_message', 'Información actualizada con éxito.');
            return redirect()->route('informacion_conjunto.index');
    
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(InformacionConjunto $informacionConjunto, $id) {
        try {
            $info = InformacionConjunto::find($id);
            $info->delete();
            session()->flash('flash_success_message', 'Información eliminada con éxito.');
            return redirect()->route('informacion_conjunto.index');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
        
    }

    public function informacion_conjunto() {
        $conjunto           = Conjunto::first();
        $info_conjunto_obj  = InformacionConjunto::first();

        $info_conjunto = [
            'dias' => $info_conjunto_obj->dias,
            'horas' => $info_conjunto_obj->horas,
            'direccion' => $conjunto->direccion,
            'nombre' => $conjunto->nombre,
            'correo' => $conjunto->administrador ? $conjunto->administrador->email : 'N/A',
            'telefonos' => $info_conjunto_obj->telefonos
        ];

        return response()->json([
            'info_conjunto' => $info_conjunto
        ]);
    }
}

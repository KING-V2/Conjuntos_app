<?php

namespace App\Http\Controllers;

use App\Models\Tarifas;
use Illuminate\Http\Request;

class TarifasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifas = Tarifas::all();
        $nombres = ['regular','nocturna','fin_de_semana', 'festivos'];
        $tipos = ['por_hora','por_dia'];
        return view ('admin.tarifas.add' ,
        [
            'tarifas' => $tarifas,
            'nombres' => $nombres,
            'tipos' => $tipos
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarifas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'costo' => 'required',
            'minutos_gavela' => 'required',
        ]);

        $tarifa = new Tarifas();
        $tarifa->nombre  = $request->input('nombre');
        $tarifa->tipo  = $request->input('tipo');
        $tarifa->costo  = $request->input('costo');
        $tarifa->minutos_gavela  = $request->input('minutos_gavela');
        $tarifa->save();
        session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('tarifas');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tarifas $tarifas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarifas $tarifas, $id)
    {
        {
            try {
                $tarifas = Tarifas::findOrfail($id);
                $nombres = ['regular','nocturna','fin_de_semana', 'festivos'];
                $tipos = ['por_hora','por_dia'];
                return view('admin.tarifas.edit',
                    [
                    'tarifas' => $tarifas,
                    'nombres' => $nombres,
                    'tipos' => $tipos
                    ]
                );
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
                return redirect('tarifas');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $tarifa = Tarifas::findOrFail($id);
            $tarifa->nombre  = $request->input('nombre');
            $tarifa->tipo  = $request->input('tipo');
            $tarifa->costo  = $request->input('costo');
            $tarifa->minutos_gavela  = $request->input('minutos_gavela');
            $tarifa->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('tarifas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarifas $tarifas, $id)
    {
        try {
            $tarifas = Tarifas::find( $id );
            $tarifas->delete();
            session()->flash('flash_success_message', 'eliminado');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }

        return redirect('tarifas');
    }
}

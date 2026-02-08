<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;

class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = Espacio::all();
        $estados = ['disponible','ocupado','reservado'];
        return view ('admin.espacios.add' ,
        [
            'espacios' => $espacios,
            'estados' => $estados
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'numero' => 'required|unique:espacios',
            'estado' => 'required',
        ]);

        $espacio = new Espacio();
        $espacio->numero  = $request->input('numero');
        $espacio->estado  = $request->input('estado');
        $espacio->save();
        session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('espacios');

    }

    /**
     * Display the specified resource.
     */
    public function show(Espacio $espacio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espacio $espacios,$id)
    {
        try {
            $espacios = Espacio::findOrfail($id);
            $estados = ['disponible','ocupado','reservado'];
            return view('admin.espacios.edit',
                [
                'espacios' => $espacios,
                'estados' => $estados
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect('espacios');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $espacio = Espacio::findOrFail($id);
            $espacio->numero  = $request->input('numero');
            $espacio->estado  = $request->input('estado');
            $espacio->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('espacios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espacio $espacios,$id)
    {
        try {
            $espacios = Espacio::find( $id );
            $espacios->delete();
            session()->flash('flash_success_message', 'eliminado');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }

        return redirect('espacios');
    }
}

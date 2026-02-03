<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view ('admin.clientes.add' ,
        [
            'clientes' => $clientes
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'nombres' => 'required',
            'numero_documento' => 'required',
            'celular' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nombres  = $request->input('nombres');
        $cliente->numero_documento  = $request->input('numero_documento');
        $cliente->email  = $request->input('email');
        $cliente->celular  = $request->input('celular');
        $cliente->save();
        session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clientes');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clientes = Cliente::with('vehiculos')-> find($id);
        //return response()->json($cliente);
        return view('admin.clientes.show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente, $id)
    {
        try {
            $clientes = Cliente::findOrfail($id);
            return view('admin.clientes.edit',
                [
                'clientes' => $clientes,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
            return redirect('clientes');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->nombres  = $request->input('nombres');
            $cliente->numero_documento  = $request->input('numero_documento');
            $cliente->email  = $request->input('email');
            $cliente->celular  = $request->input('celular');
            $cliente->save();
            session()->flash('flash_success_message', 'actualizacion correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clientes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente, $id)
    {
        try {
            $clientes = Cliente::find( $id );
            $clientes->delete();
            session()->flash('flash_success_message', 'eliminado');
            
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }

        return redirect('clientes');
    }
}

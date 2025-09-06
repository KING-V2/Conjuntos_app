<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogUsuariosRequest;
use App\Http\Requests\UpdateLogUsuariosRequest;
use App\Models\Configuracion\LogUsuarios;


class LogUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log_usuarios = LogUsuarios::all();
        
        return view('admin.log_usuarios.add',
            [
                'log_usuarios' => $log_usuarios
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogUsuariosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogUsuarios $logUsuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogUsuarios $logUsuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogUsuariosRequest $request, LogUsuarios $logUsuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogUsuarios $logUsuarios)
    {
        //
    }
}

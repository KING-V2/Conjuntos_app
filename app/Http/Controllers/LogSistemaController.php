<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogSistemaRequest;
use App\Http\Requests\UpdateLogSistemaRequest;
use App\Models\Configuracion\LogSistema;
use Illuminate\Support\Facades\DB;

class LogSistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $log_sistema = DB::table('log_sistemas')
        //     ->join('users', 'log_sistemas.usuario_id', '=', 'users.id', 'left')
        //     ->select('log_sistemas.*', 'users.name as usuario')
        //     ->orderBy('created_at', 'desc');

        $log_sistema = LogSistema::all();
        return view('admin.log_sistema.add',
            [
                'log_sistema' => $log_sistema
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
    public function store(StoreLogSistemaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogSistema $logSistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogSistema $logSistema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogSistemaRequest $request, LogSistema $logSistema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogSistema $logSistema)
    {
        //
    }
}

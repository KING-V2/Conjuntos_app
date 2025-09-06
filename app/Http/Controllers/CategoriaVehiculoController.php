<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaVehiculoRequest;
use App\Http\Requests\UpdateCategoriaVehiculoRequest;
use App\Models\Parqueaderos\CategoriaVehiculo;
use Illuminate\Http\Request;

class CategoriaVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categoria_vehiculos = CategoriaVehiculo::all();
            return view('admin.categoria_vehiculo.add',
                [
                    'categoria_vehiculos' => $categoria_vehiculos,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();    
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
    public function store(StoreCategoriaVehiculoRequest $request)
    {
        try {
            $categoria_vehiculo = new CategoriaVehiculo();
            $categoria_vehiculo->numero        = $request->input('numero');
            $categoria_vehiculo->nombre        = $request->input('nombre');
            $categoria_vehiculo->limite        = $request->input('limite');
            $categoria_vehiculo->valor        = $request->input('valor');
            try{
                $categoria_vehiculo->save();
                session()->flash('flash_success_message', 'adicion correcta');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('categoria_vehiculo')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaVehiculo $categoriaVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaVehiculo $categoriaVehiculo, $id)
    {
        try {
            $categoria_vehiculo = CategoriaVehiculo::find($id);
            return view('admin.categoria_vehiculo.edit',
                [
                    'categoria_vehiculo' => $categoria_vehiculo,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaVehiculoRequest $request)
    {

        $id                 = $request->input('categoria_vehiculo_id');
        $numero             = $request->input('numero');
        $nombre             = $request->input('nombre');
        $limite             = $request->input('limite');
        $valor              = $request->input('valor');

        try {
            $categoria_vehiculo           = CategoriaVehiculo::findOrFail( $id );
            $categoria_vehiculo->numero   = $numero;
            $categoria_vehiculo->nombre   = $nombre;
            $categoria_vehiculo->limite   = $limite;
            $categoria_vehiculo->valor    = $valor;
            try{
                $categoria_vehiculo->save();
                session()->flash('flash_success_message', 'actualizacion correcta');
            }catch ( \Exception $exception){
                session()->flash('flash_error_message', $exception->getMessage() );
            }
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('categoria_vehiculo')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaVehiculo $categoriaVehiculo,Request $request)
    {
        try {
            $id                 = $request->input('categoria_vehiculo_id');
            $categoria_vehiculo = CategoriaVehiculo::find($id);
            $categoria_vehiculo->delete();
            session()->flash('flash_success_message', 'eliminacion correcta');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('categoria_vehiculo')->withInput();
    }
}

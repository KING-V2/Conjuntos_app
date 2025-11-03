<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\PagosDescripciones;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Apartamento;
use App\Models\Administracion\Bloque;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::all();
        $meses = explode(',', env('MESES'));
        $casas = Casas::all();
        $tipos_pagos = explode(',', env('TIPOS_PAGOS'));
        return view('admin.pagos.add', compact('pagos', 'casas', 'meses', 'tipos_pagos'));
    }

    public function create()
    {
        return view('admin.pagos.create');
    }

    public function store(StorePagoRequest $request)
    {
        try {
            // 1️⃣ Obtener datos del formulario
            $tipo_pago        = $request->input('tipo_pago');
            $comentario_admin = $request->input('comentario_admin');
            $adjunto_notificacion = $request->file('adjunto_notificacion');

            if ( $tipo_pago === 'Administracion' ) 
            {
                $bloques = Bloque::all();
                $apartamentos = Apartamento::all();

                
                $meses = explode(',', env('MESES', 'Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre'));

                $file_name = null;
                if (!empty($adjunto_notificacion)) {
                    $fecha = date('YmdHis') . rand(0, 9);
                    $file_name = 'file_' . $fecha . '.' . $adjunto_notificacion->getClientOriginalExtension();
                    Storage::disk('storage_pagos')->put($file_name, file_get_contents($adjunto_notificacion));
                }

                foreach ($casas as $casa) 
                {
                    foreach ($meses as $mes) 
                    {
                        Pago::create([
                            'tipo_pago'        => $tipo_pago,
                            'casa_id'        => $casa->id,
                            'mes'              => trim($mes),
                            'comentario_admin' => $comentario_admin,
                            'adjunto_notificacion'      => $file_name,
                            'estado'           => 'Pendiente',
                        ]);
                    }
                }
            }
            
            if ( $tipo_pago === 'Extra Ordinario'  ) {

                
                $bloques = Bloque::all();
                $meses = $request->input('mes');

                // 4️⃣ Si hay archivo adjunto, guardarlo una vez (y usarlo para todos)
                $file_name = null;
                if (!empty($adjunto_notificacion)) {
                    $fecha = date('YmdHis') . rand(0, 9);
                    $file_name = 'file_' . $fecha . '.' . $adjunto_notificacion->getClientOriginalExtension();
                    Storage::disk('storage_pagos')->put($file_name, file_get_contents($adjunto_notificacion));
                }

                // 5️⃣ Crear los pagos por cada bloque, apartamento y mes
                foreach ($bloques as $bloque) {
                    Pago::create([
                        'tipo_pago'        => $tipo_pago,
                        'casa_id'          => $casa->id,
                        'mes'              => $meses,
                        'comentario_admin' => $comentario_admin,
                        'adjunto'          => $file_name,
                        'estado'           => 'Pendiente',
                    ]);
                }
            }
            
        if ( $tipo_pago === 'Multa' || $tipo_pago === 'Llamado De Atencion') {
                $pago = new Pago();
                $pago->tipo_pago            = $request->input('tipo_pago');
                $pago->casa_id            = $request->input('casa_id');
                $pago->mes                  = $request->input('mes');
                $pago->comentario_admin     = $request->input('comentario_admin');
                $adjunto_notificacion       = $request->file('adjunto_notificacion');

                if( !empty( $adjunto_notificacion ) )
                {
                    $fecha      = date('Ymdhis').rand(0,9);
                    $file_name  = 'file_'.$fecha.'.'.$adjunto_notificacion->getClientOriginalExtension();
                    $pago->adjunto    = $file_name;
                    Storage::disk('storage_pagos')->put($file_name , file_get_contents($adjunto_notificacion) );
                }
                $pago->save();
            }

            session()->flash('flash_success_message', 'Pagos generados correctamente para todos los bloques y apartamentos.');
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', 'Error: ' . $exception->getMessage());
        }

        return redirect('pagos');
    }

    public function show(Pago $pago)
    {
        return view('admin.pagos.show', compact('pago'));
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $residentes = Residente::all();
        return view('admin.pagos.edit', compact('pago', 'residentes'));
    }

    public function update(UpdatePagoRequest $request)
    {
         try {
            $pago = Pago::findOrFail($request->input('pago_id'));
            $pago->estado       = $request->input('estado');
            $pago->administrador_id  = Auth()->user()->id;
            $pago->save();

            session()->flash('flash_success_message', 'registro correcto');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }

        return redirect('pagos');
    }

    public function destroy($id)
    {
        try {
            $pago = Pago::findOrFail($id);

            // 🔹 Si existe un adjunto, eliminarlo del almacenamiento
            if ($pago->adjunto && Storage::disk('storage_pagos')->exists($pago->adjunto)) {
                Storage::disk('storage_pagos')->delete($pago->adjunto);
            }

            // 🔹 Luego eliminar el registro de la base de datos
            $pago->delete();

            session()->flash('flash_success_message', 'Registro eliminado correctamente');
            return redirect('pagos');

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
            return redirect('pagos');
        }
    }

    public function getPagos($bloque,$tipo)
    {
        $pagos = Pago::where('casa_id', $bloque)
                        ->where('tipo_pago', $tipo)
                        ->get();

        // Obtener las circulares del año en curso

        // Verificar si hay resultados
        if ($pagos->isEmpty()) {
            return response()->json([
                'message' => 'No hay pagos disponibles de este tipo.'
            ], 404, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        // Retornar las circulares encontradas
        return response()->json($pagos, 200, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    public function uploadAdjuntoPago(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'archivo' => 'required|file|max:5120', // 5MB máximo
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $pago = Pago::where('id', $request->input('pago_id'))->first();

        $file = $request->file('archivo');
        
        $fecha      = date('Ymdhis').rand(0,9);
        $file_name  = 'file_'.$fecha.'.'.$file->getClientOriginalExtension();
        $pago->adjunto    = $file_name;
        Storage::disk('storage_pagos')->put($file_name , file_get_contents($file) );

        return response()->json([
            'status' => 'success',
            'message' => 'Archivo guardado correctamente',
            'path' => $path, // puedes guardar esto en tu BD si quieres
            'url' => asset('storage/uploads/' . $file_name) 
        ]);
    }


}

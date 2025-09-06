<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGaleriaEmprendimientosRequest;
use App\Http\Requests\UpdateGaleriaEmprendimientosRequest;
use App\Models\Emprendimientos\GaleriaEmprendimientos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GaleriaEmprendimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function lista()
    {
        try{
            $galeria = GaleriaEmprendimientos::get();

            return view('admin.galeria_emprendimientos.add',
                [
                    'emprendimientos' => $galeria
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('galeria_emprendimientos');
    }

    public function index($id)
    {
        try{
            $galeria = DB::table('galeria_emprendimientos')->where('emprendimiento_id','=', $id)->get();

            return view('admin.galeria_emprendimientos.add',
                [
                    'emprendimientos' => $galeria,
                    'emprendimiento_id' => $id
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('emprendimientos');
    }

    /**
 * Show the form for creating a new resource.
 */
public function create(Request $request)
{
    // Validar que el campo 'imagenes' y 'emprendimiento_id' estén presentes
    $validate = $request->validate([
        'imagenes' => 'required',
        'emprendimiento_id' => 'required'
    ]);

    $emprendimiento = $request->input('emprendimiento_id');
    $imagenes = $request->file('imagenes'); // Recoge las múltiples imágenes

    if ($imagenes && is_array($imagenes)) {
        try {
            foreach ($imagenes as $imagen) {
                $fecha = date('Ymdhis') . rand(0, 9);
                $file_name = 'file_' . $fecha . '.' . $imagen->getClientOriginalExtension();

                $archivo = new GaleriaEmprendimientos();
                $archivo->imagen = $file_name;
                $archivo->emprendimiento_id = $emprendimiento;

                Storage::disk('storage_galeria')->put($file_name, file_get_contents($imagen));

                $archivo->save();
            }
            session()->flash('flash_success_message', 'Imágenes subidas correctamente');
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
        }
    } else {
        session()->flash('flash_error_message', 'No se encontraron imágenes para cargar.');
    }

    // Volver atrás con los datos enviados en caso de fallo
    return back()->withInput();
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGaleriaEmprendimientosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GaleriaEmprendimientos $galeriaEmprendimientos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriaEmprendimientos $galeriaEmprendimientos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGaleriaEmprendimientosRequest $request, GaleriaEmprendimientos $galeriaEmprendimientos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if ($id  > 0 && $id != null ) 
            {
                $file = GaleriaEmprendimientos::findOrFail( $id );
                $file->delete();
                
                session()->flash('flash_success_message', 'eliminado correctamente');
            }
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return back();
    }

    public function getGaleriaEmprendimientos($id){
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $galeria = GaleriaEmprendimientos::where('emprendimiento_id','=',$id)->get();
        return response()->json($galeria, 200, $header);
    }

}

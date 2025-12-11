<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCasasRequest;
use App\Http\Requests\UpdateCasasRequest;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Residente;
use App\Models\User;

class CasasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $casas = Casas::all();
            $conjunto = Conjunto::first();
            $residentes = Residente::all();
            $usuarios = User::all();
            return view('admin.casas.add',
                [
                    'casas' => $casas,
                    'conjunto' => $conjunto,
                    'residentes' => $residentes,
                    'usuarios' => $usuarios,
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
    public function showall()
    {
        try {
            $casas = Casas::paginate(20);
            return view('admin.casas.showall', compact('casas'));
        } catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCasasRequest $request)
    {
        try {
            $casa = new Casas();
            $casa->nombre        = $request->input('nombre');
            $casa->codigo        = '0000';
            $casa->conjunto_id   = Conjuntos::first()->id;       
            $casa->save();
            $json = json_encode( $request->all() );
            log_evento('Registro Casas', $json);
            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('Casas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Casas $casa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Casas $casa, $id)
    {
        try{
            $casa     = Casas::findOrFail( $id );
            $conjunto   = Conjunto::all();
            return view('admin.casas.edit',
                [
                    'casa'    => $casa,
                    'conjuntos'  => $conjunto,
                ]
            );
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('citofonia');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCasasRequest $request, Casas $casa)
    {
        try {
            $casa =   Casas::find( $request->input('casa_id') );
            $casa->nombre        = $request->input('nombre');
            $casa->codigo        = $request->input('codigo');
            $casa->conjunto_id   = $request->input('conjunto_id');
            $casa->telefono_uno  = $request->input('telefono_uno');
            $casa->telefono_dos  = $request->input('telefono_dos');
            $casa->telefono_tres = $request->input('telefono_tres');
            $casa->telefono_cuatro = $request->input('telefono_cuatro');
            $casa->telefono_cinco = $request->input('telefono_cinco');

            $casa->save();
            $json = json_encode( $request->all() );
            log_evento('Actualizacion Casa', $json);
            session()->flash('flash_success_message', 'actualizacion correcta');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('citofonia');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Casas $casa, $id)
    {
        try {
            $casa = Casas::find( $id );
            $casa->delete();
            $json = json_encode( $request->all() );

            log_evento('Eliminacion casa', [
                'id' => $id
            ]);
            session()->flash('flash_success_message', 'registro eliminado');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('casas');
    }

    public function getCasas($conjunto_id) {
        $casas = Casas::where('conjunto_id', $conjunto_id)->get();
        return response()->json($casas);
    }

    public function getCasasApi() {
        $casas = Casas::all();
        return response()->json($casas);
    }

    public function exportExcel()
    {
        $casas = Casas::select(
            'nombre',
            'telefono_uno',
            'telefono_dos',
            'telefono_tres',
            'telefono_cuatro',
            'telefono_cinco'
        )->get();

        $fileName = 'casas_' . now()->format('Ymd_His') . '.xls';

        // Encabezados para descargar archivo Excel
        $headers = [
            "Content-Type" => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
            "Pragma" => "no-cache",
            "Expires" => "0",
        ];

        // Inicio del XML
        $content  = '<?xml version="1.0"?>';
        $content .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                            xmlns:x="urn:schemas-microsoft-com:office:excel"
                            xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
        $content .= '<Worksheet ss:Name="Casas"><Table>';

        // Encabezados
        $content .= '<Row>
                        <Cell><Data ss:Type="String">Nombre</Data></Cell>
                        <Cell><Data ss:Type="String">Telefono uno</Data></Cell>
                        <Cell><Data ss:Type="String">Telefono dos</Data></Cell>
                        <Cell><Data ss:Type="String">Telefono tres</Data></Cell>
                        <Cell><Data ss:Type="String">Telefono cuatro</Data></Cell>
                        <Cell><Data ss:Type="String">Telefono cinco</Data></Cell>
                    </Row>';

        // Datos
        foreach ($casas as $casa) {
            $content .= '<Row>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->nombre) . '</Data></Cell>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->telefono_uno) . '</Data></Cell>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->telefono_dos) . '</Data></Cell>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->telefono_tres) . '</Data></Cell>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->telefono_cuatro) . '</Data></Cell>';
            $content .= '<Cell><Data ss:Type="String">' . htmlspecialchars($casa->telefono_cinco) . '</Data></Cell>';
            $content .= '</Row>';
        }

        // Cierre del XML
        $content .= '</Table></Worksheet></Workbook>';

        return response($content, 200, $headers);
    }
}

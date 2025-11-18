<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Residente;
use App\Models\Parqueadero;
use App\Models\RegistroParqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreResidenteRequest;
use App\Http\Requests\UpdateResidenteRequest;

use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ResidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residentes = Residente::all();
        $casas  = Casas::all();
        $usuarios   = User::all();
        
        return view('admin.residentes.add',
            [
                'residentes' => $residentes,
                'casas' => $casas,
                'usuarios' => $usuarios
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
    public function store(StoreResidenteRequest $request)
    {
        try {
            $residente = new Residente();
            $residente->conjunto_id     = 1;
            $residente->casa_id       = $request->input('casa_id');
            $residente->usuario_id      = $request->input('usuario_id');
            $residente->estado          = $request->input('estado');
            $residente->tipo_residente  = $request->input('tipo_residente');
            $residente->save();

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('residentes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Residente $residente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residente $residente,$id)
    {
        try{
            $residente  = Residente::findOrFail( $id );
            $conjuntos  = Conjunto::all();
            $casas = Casas::all();
            $registro_parqueaderos = RegistroParqueadero::where('casa_id', $residente->casas->id)->get();
            $usuarios = User::findOrFail($residente->usuario->id);
            
            return view('admin.residentes.edit',
                [
                    'residente' => $residente,
                    'conjuntos' => $conjuntos,
                    'casas' => $casas,
                    'registro_parqueaderos' => $registro_parqueaderos
                ]
            );

        } catch (\Exception $ex) {
            session()->flash('flash_error_message', $ex->getMessage() );
        }
        return redirect('residentes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidenteRequest $request, Residente $residente)
    {
        try {
            $residente = Residente::find( $request->input('residente_id') );
            $residente->conjunto_id      = Conjunto::first()->id;
            $residente->casa_id        = $request->input('casa_id');
            $residente->estado           = $request->input('estado');
            $residente->tipo_residente   = $request->input('tipo_residente');
            
            if ( !empty( $request->input('parqueadero_id') ) ) {
                $residente->parqueadero_id   = $request->input('parqueadero_id');
                
                $parqueadero = Parqueadero::find( $request->input('parqueadero_id') )->first();
                $parqueadero->estado = 'Asignado';
                $parqueadero->save();
            }
            
            $residente->save();

            session()->flash('flash_success_message', 'actualizado correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('residentes');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residente $residente, $id)
    {
        try {
            $residente = Residente::find($id);
            $residente->delete();
            session()->flash('flash_success_message', 'eliminado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('residentes');
    }

    public function searchResidenteJson(Request $request)
    {
        // Iniciar la consulta con las relaciones foráneas
        $query = Residente::with(['casas', 'usuario']);
    
        // Aplicar filtro por bloque si está presente
        if ($request->has('filter_casa_id') && !empty($request->filter_casa_id)) {
            $query->where('casa_id', $request->filter_casa_id);
        }
        
        // Aplicar filtro por usuario si está presente
        if ($request->has('filter_usuario_id') && !empty($request->filter_usuario_id)) {
            $query->where('usuario_id', $request->filter_usuario_id);
        }
    
        // Aplicar filtro por estado si está presente
        if ($request->has('filter_estado') && !empty($request->filter_estado)) {
            $query->where('estado', $request->filter_estado);
        }
    
        // Aplicar filtro por tipo de residente si está presente
        if ($request->has('filter_tipo_residente') && !empty($request->filter_tipo_residente)) {
            $query->where('tipo_residente', $request->filter_tipo_residente);
        }
    
        return DataTables::of($query)
            ->addColumn('usuario', function($residente) {
                return $residente->usuario ? $residente->usuario->name : 'Sin usuario asignado';
            })
            // Añadir las columnas relacionadas ( usuario)
            ->addColumn('casas', function($residente) {
                return $residente->casas ? $residente->casas->nombre : 'Sin casa asignada';
            })
            
            // Agregar la columna de acciones
            ->addColumn('actions', function($residente) {
                return '<a href="'.route('residentes.edit', $residente->id).'" class="btn btn-sm btn-primary">Editar</a>
                        <a href="'.route('residentes.delete', $residente->id).'" class="btn btn-sm btn-danger">Eliminar</a>';
            })
            // Formatear la respuesta
            ->rawColumns(['actions']) // Permitir HTML en la columna de acciones
            ->make(true);
    }

    public function registrarResidente(Request $request){
        
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];

        try {
            $residente = new Residente();
            $residente->conjunto_id    = $request->input('modal_conjunto_id');
            $residente->casa_id      = $request->input('modal_casa_id');
            $residente->usuario_id     = $request->input('modal_usuario_id');
            $residente->estado         = $request->input('modal_estado');
            $residente->tipo_residente = $request->input('modal_tipo_residente');
            $residente->save();

            return response()->json(['message' => 'Residente Registrado'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage() ], 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }   

    public function listaResidentes()
    {
        try {
            $lista_residentes = Residente::with(['usuario', 'casas'])->get();

            $residentes = $lista_residentes->map(function ($residente) {
                return [
                    'id' => $residente->id,
                    'nombre' => $residente->usuario->name . ' - ' . $residente->casa->nombre,
                ];
            });

            return response()->json($residentes, 200, [
                'Content-Type' => 'application/json',
                'charset' => 'utf-8',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500, [
                'Content-Type' => 'application/json',
                'charset' => 'utf-8',
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function residenteQrInfo($user_id,$tipo_residente,$cod_apartamento)
    {
        //obtencion apartamento
        $apartamento     = Apartamento::where( 'codigo',$cod_apartamento)->first();

        //obtencion residente
        $residentes = Residente::where('usuario_id', $user_id)
                                ->where('tipo_residente', $tipo_residente)->get();
        $residente = $residentes->first();

        return view('admin.residentes.show_qr',
            [
                'info_residente' => $residente,
            ]
        );
    }

    public function informacion_residente($id)
    {
        try {
            $conjunto = Conjunto::first();

            // Obtener residente (único)
            $residente = Residente::with(['usuario', 'casas'])
                ->where('usuario_id', $id)
                ->firstOrFail();

            // Obtener ID de casa
            $casa_id = $residente->casas->id ?? $residente->casas->first()->id ?? null;

            // Obtener parqueaderos de esa casa
            $parqueaderos = RegistroParqueadero::with(['vehiculo', 'parqueadero'])
                ->where('casa_id', $casa_id)
                ->get();

            // Estructura del residente
            $info_residente = [
                'residente' => $residente->usuario->name ?? '',
                'email' => $residente->usuario->email ?? '',
                'tipo_residente' => $residente->tipo_residente ?? '',
                'conjunto' => $conjunto->nombre ?? 'No definido',
                'casa' => $residente->casas->nombre ?? 'No disponible',
            ];

            // Estructura de parqueaderos
            $info_parqueaderos = $parqueaderos->map(function ($parqueadero) {
                return [
                    'parqueadero' => $parqueadero->parqueadero->nombre ?? '',
                    'vehiculo' => $parqueadero->vehiculo->placa ?? '',
                ];
            });

            return response()->json([
                'residente' => $info_residente,
                'parqueaderos' => $info_parqueaderos,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => $th->getMessage(),
            ], 500);
        }
    }

    public function importarResidentes(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,csv,txt',
        ]);

        $path = $request->file('archivo')->store('importaciones');

        $rows = SimpleExcelReader::create(storage_path('app/' . $path))->getRows();

        $importados = 0;
        $errores = [];
        $conjunto = Conjunto::latest()->first();

        foreach ($rows as $index => $row) 
        {
            try {
                // ============================
                // 1. BUSCAR O CREAR USUARIO
                // ============================
                $existingUser = User::where('email', $row['CORREO'])->first();

                if ($existingUser) {
                    // Usuario existente encontrado
                    $user = $existingUser;
                } else {
                    // Crear usuario nuevo
                    $telefono = '3' . str_pad(random_int(0, 999_999_999), 9, '0', STR_PAD_LEFT);

                    $user = User::create([
                        'name'        => $row['NOMBRE_RESIDENTE'],
                        'email'       => $row['CORREO'],
                        'password'    => Hash::make($telefono),
                        'login_web'   => '0',
                        'login_mobile'=> '1',
                    ]);

                    $user->assignRole('residente');
                }

                if (!$user) {
                    throw new \Exception("No se pudo crear o asignar el usuario en la fila " . ($index + 1));
                }

                // ============================
                // 2. BUSCAR CASA
                // ============================
                $casa = Casas::where('nombre', 'LIKE', "Casa %{$row['CASA']}%")->first();

                if (!$casa) {
                    throw new \Exception("No se encontró la casa para la fila " . ($index + 1));
                }

                // ============================
                // 3. CREAR / ACTUALIZAR RESIDENTE
                // ============================
                $residente = Residente::updateOrCreate(
                    [
                        'usuario_id'  => $user->id,
                        'casa_id'     => $casa->id
                    ],
                    [
                        'conjunto_id'    => $conjunto->id,
                        'tipo_residente' => $row['TIPO_RESIDENTE'] ?? null,
                        'estado'         => 'Activo',
                        'correo'         => $row['CORREO'] ?? null,
                        'password'       => Hash::make($row['PASSWORD'] ?? '123456'),
                    ]
                );

                // ============================
                // 4. ACTUALIZAR TELÉFONOS CASA
                // ============================
                $casa->update([
                    'telefono_uno'    => $row['TELEFONO_UNO'] ?? null,
                    'telefono_dos'    => $row['TELEFONO_DOS'] ?? null,
                    'telefono_tres'   => $row['TELEFONO_TRES'] ?? null,
                    'telefono_cuatro' => $row['TELEFONO_CUATRO'] ?? null,
                    'telefono_cinco'  => $row['TELEFONO_CINCO'] ?? null
                ]);

                // ============================
                // 5. CREAR VEHÍCULO SI EXISTE
                // ============================
                $vehiculo = null;

                if (!empty($row['TIPO_VEHICULO']) && !empty($row['PLACA'])) {
                    $vehiculo = Vehiculo::create([
                        'tipo_vehiculo' => $row['TIPO_VEHICULO'],
                        'placa'         => $row['PLACA'],
                    ]);
                }

                // ============================
                // 6. BUSCAR PARQUEADERO
                // ============================
                $parqueadero = null;

                if (!empty($row['PARQUEADERO'])) {
                    $parqueadero = Parqueadero::where('nombre', 'LIKE', "%{$row['PARQUEADERO']}%")->first();
                }

                // ============================
                // 7. REGISTRAR VEHÍCULO EN PARQ.
                // ============================
                if ($vehiculo && $parqueadero) {
                    RegistroParqueadero::create([
                        'vehiculo_id'    => $vehiculo->id,
                        'parqueadero_id' => $parqueadero->id,
                        'casa_id'        => $casa->id,
                    ]);
                }

                $importados++;

            } catch (\Throwable $e) {
                $errores[] = "Fila " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        Storage::delete($path);

        return back()->with([
            'success' => "Importación completada: {$importados} registros importados correctamente.",
        ]);
    }




}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistroPersonasRequest;
use App\Http\Requests\UpdateRegistroPersonasRequest;
use App\Models\RegistroPersonas;
use App\Models\Parqueadero;
use App\Models\Administracion\Casas;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistroPersonasController extends Controller
{

    public function index()
    {
        $meses = explode(',', env('MESES'));
        $parqueaderos = Parqueadero::all();
        $casas = Casas::all();
        // No cargamos registros completos aquí (serverSide)
        return view('admin.registro_personas.index', compact('meses', 'parqueaderos', 'casas'));
    }

    /**
     * Endpoint para DataTables serverSide
     */
    public function buscar(Request $request)
    {
        $query = RegistroPersonas::with(['casas']);

        // Filtros opcionales (si los envía el cliente)
        if ($request->filled('mes')) {
            $query->where('mes', $request->mes);
        }

        if ($request->filled('casa_id')) {
            $query->where('casa_id', $request->casa_id);
        }

        return datatables()
            ->eloquent($query)
            ->addColumn('casas', function ($row) {
                return $row->casas ? $row->casas->nombre : 'N/A';
            })
            ->addColumn('foto', function ($row) {
                // Opción 2: mostrar un botón/enlace que abra la imagen en nueva pestaña (si existe)
                if ($row->foto) {
                    $url = asset('storage/registro_personas/' . $row->foto);
                    return '<a href="'.$url.'" target="_blank" class="btn btn-sm btn-outline-primary">Ver Foto</a>';
                }
                return '<span class="text-muted">Sin foto</span>';
            })
            ->addColumn('acciones', function ($row) {
                $edit = '<a href="'.route('registro-personas.edit', $row->id).'" class="btn btn-sm btn-primary me-1">Editar</a>';
                $del = '<form method="POST" action="'.route('registro-personas.destroy', $row->id).'" style="display:inline">'
                     . csrf_field()
                     . method_field('DELETE')
                     . '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Eliminar registro?\')">Eliminar</button>'
                     . '</form>';
                return $edit . $del;
            })
            ->rawColumns(['foto', 'acciones']) // permitimos HTML en estas columnas
            ->toJson();
    }

    /**
     * Endpoint para autocompletar por documento (usa en formulario)
     */
    public function buscarPersona($documento)
    {
        $persona = RegistroPersonas::where('documento', $documento)->first();

        if (!$persona) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'nombre' => $persona->nombre,
            'casa_id' => $persona->casa_id,
        ]);
    }
    

    // 🔹 Formulario de creación
    public function create()
    {
        $casas = Casas::all();
        return view('admin.registro_personas.create', compact('casas'));
    }

    // 🔹 Guardar nuevo registro
    public function store(StoreRegistroPersonasRequest $request)
    {
        $data = $request->all();
        Carbon::setLocale('es');
        $mes = Carbon::now()->translatedFormat('F');
        $data['mes'] = ucfirst($mes);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('registro_personas', 'public');
        }

        RegistroPersonas::create($data);

        return redirect('registro_personas')->with('success', 'Registro creado exitosamente.');
    }

    // 🔹 Formulario de edición
    public function edit($id)
    {
        $registro = RegistroPersonas::findOrFail($id);
        $casas = Casas::all();

        return view('admin.registro_personas.edit', compact('registro', 'casas'));
    }

    // 🔹 Actualizar registro
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|integer',
    //         'nombre' => 'required|string|max:255',
    //         'documento' => 'required|string|max:50',
    //         'mes' => 'required|string|max:20',
    //         'foto' => 'nullable|image|max:2048',
    //         'bloque_id' => 'required|integer',
    //         'apartamento_id' => 'required|integer',
    //     ]);

    //     $registro = RegistroPersonas::findOrFail($request->id);
    //     $data = $request->all();

    //     if ($request->hasFile('foto')) {
    //         $data['foto'] = $request->file('foto')->store('fotos', 'public');
    //     }

    //     $registro->update($data);

    //     return redirect('registro_personas')->with('success', 'Registro actualizado correctamente.');
    // }

    // 🔹 Eliminar registro
    public function destroy($id)
    {
        $registro = RegistroPersonas::findOrFail($id);
        $registro->delete();
        return redirect('registro_personas')->with('success', 'Registro eliminado correctamente.');
    }

    public function registroPersonasApi(Request $request)
    {
        // 🔹 Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|max:50',
            'casa_id' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Máx 5 MB
        ]);

        // 🔹 Obtener el mes actual en español
        $mesActual = ucfirst(Carbon::now()->locale('es')->translatedFormat('F'));

        // 🔹 Subir la foto
        $rutaFoto = null;
        if ($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $rutaFoto = $archivo->storeAs('registro_personas', $nombreArchivo, 'public');
        }

        // 🔹 Guardar registro
        $registro = RegistroPersonas::create([
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'mes' => $mesActual,
            'foto' => $rutaFoto,
            'casa_id' => $request->casa_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registro guardado correctamente.',
            'data' => $registro
        ], 200);
    }
}

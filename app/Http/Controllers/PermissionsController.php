<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Permissions;

class PermissionsController extends Controller
{
    /// Listar permisos y mostrar el formulario de creación
    public function index()
    {
        $permissions = Permissions::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    // Crear un nuevo permiso
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name|max:255',
        ]);

        $permiso = Permissions::create(['name' => $request->name, 'guard_name' => 'web']);
        $superAdmin = Role::find(1);
        $superAdmin->givePermissionTo( $permiso);

        return redirect()->route('permissions.index')->with('success', 'Permiso creado correctamente.');
    }
}

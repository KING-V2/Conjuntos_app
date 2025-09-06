<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Lista todos los roles
    public function index()
    {
        if (auth()->user()->can('role')) {
            $roles = Role::all();
        }else{
            $roles = [];
            session()->flash('flash_error_message', 'No tiene permisos para realizar esta accion' );
        }
        return view('admin.roles.index', compact('roles'));
    }

    // Muestra el formulario para crear un nuevo rol
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // Guarda un nuevo rol
    public function store(Request $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);
            $role->givePermissionTo($request->permissions);
            session()->flash('flash_success_message', 'registro correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect()->route('roles.index');

    }

    // Muestra el formulario para editar un rol
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'permissions' => 'array|nullable',
        ]);
        $role = Role::find($id);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente.');
    }

    // Elimina un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }

    
    public function assignPermissionsForm($id)
    {
        try {
            $role = Role::findById($id);
            $permissions = Permission::all();

            return view('admin.roles.assign_permissions', compact('role', 'permissions'));
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
    }

    public function assignPermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

            // Validar que los permisos sean nombres válidos
            $request->validate([
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,name', // Validación por nombre, no por id
            ]);

            // Asignar los permisos al rol
            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.index')->with('success', 'Permisos asignados exitosamente.');
    }
}

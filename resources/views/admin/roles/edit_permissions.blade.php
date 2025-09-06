@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Permisos para el Rol: {{ $role->name }}</h2>
    <form action="{{ route('roles.updatePermissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="permissions">Permisos</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" 
                        @if($role->hasPermissionTo($permission->name)) selected @endif>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar Permisos</button>
    </form>
</div>
@endsection

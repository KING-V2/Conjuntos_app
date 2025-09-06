@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Editar Permisos del Rol: {{ $role->name }}</h1>
        <div class="card-body">
            <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <h5>Permisos disponibles:</h5>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                    >
                                    <label for="perm_{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="{{ route('roles.permissions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection

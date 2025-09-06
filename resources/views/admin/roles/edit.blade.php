@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Editar Rol: {{ $role->name }}</h1>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- <div class="form-group">
                <label for="name">Nombre del Rol</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
            </div> -->

            <div class="form-group mt-3">
                <label for="permissions">Permisos</label>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                    id="permission_{{ $permission->id }}" 
                                    class="form-check-input"
                                    @if($role->hasPermissionTo($permission->name)) checked @endif
                                >
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ ucfirst($permission->name) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Actualizar Rol</button>
            </form>
        </div>
    </div>
</div>
@endsection

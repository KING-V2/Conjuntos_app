@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Crear Nuevo Rol</h1>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Rol</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="permissions">Permisos</label>
                    <div class="form-check">
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                    id="permission_{{ $permission->id }}" 
                                    class="form-check-input"
                                >
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Crear Rol</button>
            </form>
        </div>
    </div>
</div>
@endsection

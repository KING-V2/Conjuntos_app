@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Asignar Permisos al Rol: {{ $role->name }}</h2>
    <form action="{{ route('roles.assignPermissions', $role->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="permissions">Seleccionar permisos:</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar permisos</button>
    </form>

</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Permiso: {{ $permission->name }}</h2>
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

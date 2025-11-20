@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Crear Nuevo Permiso</h2>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del permiso" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

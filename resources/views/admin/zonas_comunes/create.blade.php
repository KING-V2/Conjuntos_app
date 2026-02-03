@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes</h1>
        <div class="card-body">
            <h3>{{ isset($zona) ? 'Editar Zna' : 'Nueva Zona' }}</h3>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ isset($zona) ? route('zonas.update', $zona->id) : route('zonas.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Nombre</label>
                    <input name="nombre" class="form-control" value="{{ old('nombre', $zona->nombre ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $zona->descripcion ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="Activo" {{ old('estado', $zona->estado ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $zona->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button class="btn btn-success">{{ isset($zona) ? 'Actualizar' : 'Crear' }}</button>
                <a href="{{ route('zonas.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection

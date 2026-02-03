@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Zonas Comunes</h1>
        <div class="card-body">
            <h3>{{ isset($zona) ? 'Editar Zoa' : 'Nueva Zona' }}</h3>
            <form action="{{ isset($zona) ? route('zonas.update') : route('zonas.store') }}" method="POST">
                @csrf

                @if(isset($zona))
                    <input type="hidden" name="id" value="{{ $zona->id }}">
                @endif

                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $zona->nombre ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $zona->descripcion ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="Activo" {{ isset($zona) && $zona->estado=='Activo' ? 'selected':'' }}>Activo</option>
                        <option value="Inactivo" {{ isset($zona) && $zona->estado=='Inactivo' ? 'selected':'' }}>Inactivo</option>
                    </select>
                </div>

                <button class="btn btn-success">Guardar</button>
                <a href="{{ route('zonas.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection

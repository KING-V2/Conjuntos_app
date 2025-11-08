@extends('layouts.admin')

@section('content')
<div class="container col-md-6">
    <h3>{{ isset($zona) ? 'Editar Zona Común' : 'Nueva Zona Común' }}</h3>

    <form action="{{ isset($zona) ? route('zonas.update', $zona->id) : route('zonas.store') }}" 
          method="POST">
        @csrf
        @if(isset($zona)) @method('PUT') @endif

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ $zona->nombre ?? '' }}" required>
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
@endsection

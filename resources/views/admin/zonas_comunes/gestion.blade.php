@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Editar Zon</h2>

    <form action="/zonas_comunes_update" method="POST">
        @csrf
        <input type="hidden" name="zona_id" value="{{ $zona->id }}" class="form-control mb-2" required style="display:none;">

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $zona->nombre }}" class="form-control mb-2" required>
        
        <label>Límite</label>
        <input type="number" name="limite" value="{{ $zona->limite }}" class="form-control mb-2" required>

        <label>Tipo</label>
        <select name="tipo" class="form-control" required>
            <option value="">Seleccione</option>
            <option value="general" {{ $zona->tipo == 'general' ? 'selected' : '' }}>General</option>
            <option value="piscina" {{ $zona->tipo == 'piscina' ? 'selected' : '' }}>Piscina</option>
            <option value="gimnasio" {{ $zona->tipo == 'gimnasio' ? 'selected' : '' }}>Gimnasio</option>
        </select>

        <label for="estado">Estado</label>
        <select name="estado" id="estado" class="form-control" required>
            <option value="Activo" {{ $zona->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="No Activo" {{ $zona->estado == 'No Activo' ? 'selected' : '' }}>No Activo</option>
        </select>
    
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control mb-2">{{ $zona->descripcion }}</textarea>

        <button class="btn btn-success">Actualizar</button>
        <a href="/zonas" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">{{ isset($informacionConjunto) ? 'Editar Información' : 'Agregar Información' }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ isset($informacionConjunto) ? url('informacion_conjunto_update') : url('informacion_conjunto_store') }}" method="POST">
                @csrf
                @if (isset($informacionConjunto))
                    @method('PUT')
                @endif

                @php
                    $diasSeleccionados = isset($informacionConjunto) ? json_decode($informacionConjunto->dias, true) : [];
                    $diasSeleccionados = is_array($diasSeleccionados) ? $diasSeleccionados : [];
                @endphp

                <!-- Días de atención -->
                <div class="form-group mb-3">
                    <label class="form-label">Días de atención</label>
                    <div class="row">
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="dias[]" value="{{ $dia }}" 
                                        {{ in_array($dia, $diasSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $dia }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Texto de Horas -->
                <div class="form-group mb-3">
                    <label class="form-label">Texto de Horas</label>
                    <textarea name="texto_horas" class="form-control" rows="2" placeholder="Ej: Atención de 8:00 a.m. a 5:00 p.m.">{{ old('texto_horas', $informacionConjunto->texto_horas ?? '') }}</textarea>
                </div>

                <!-- Texto Adicional -->
                <div class="form-group mb-3">
                    <label class="form-label">Texto Adicional</label>
                    <textarea name="texto_adicional" class="form-control" rows="3" placeholder="Ej: Cerrado en festivos">{{ old('texto_adicional', $informacionConjunto->texto_adicional ?? '') }}</textarea>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

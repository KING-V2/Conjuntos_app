@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Agregar Información</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('informacion_conjunto_store') }}" method="POST">
                @csrf

                <!-- Días de atención -->
                <div class="form-group mb-3">
                    <label class="form-label">Días de atención</label>
                    <textarea name="dias" class="form-control" rows="2" placeholder="Ej: Lunes a Viernes, Sábados medio día">{{ old('dias') }}</textarea>
                </div>

                <!-- Texto de Horas -->
                <div class="form-group mb-3">
                    <label class="form-label">Texto de Horas</label>
                    <textarea name="texto_horas" class="form-control" rows="2" placeholder="Ej: Atención de 8:00 a.m. a 5:00 p.m.">{{ old('texto_horas') }}</textarea>
                </div>

                <!-- Texto Adicional -->
                <div class="form-group mb-3">
                    <label class="form-label">Texto Adicional</label>
                    <textarea name="texto_adicional" class="form-control" rows="3" placeholder="Ej: Cerrado en festivos">{{ old('texto_adicional') }}</textarea>
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

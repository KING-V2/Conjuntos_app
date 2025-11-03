@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Editar Mensaje</h5>
        <div class="card-body">
            <form action="{{ route('mensajes_vistas.update', $mensaje->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Vista</label>
                   <select class="form-control" name="vista" id="vista">
                        <option value="Trasteos" {{ $mensaje->vista == 'Trasteos' ? 'selected' : '' }}>Trasteos</option>
                        <option value="Reservas" {{ $mensaje->vista == 'Reservas' ? 'selected' : '' }}>Reservas</option>
                        <option value="ZonaComun" {{ $mensaje->vista == 'ZonaComun' ? 'selected' : '' }}>Reservas</option>
                        <option value="Pagos" {{ $mensaje->vista == 'Pagos' ? 'selected' : '' }}>Pagos</option>
                        <option value="Emprendimientos" {{ $mensaje->vista == 'Emprendimientos' ? 'selected' : '' }}>Emprendimientos</option>
                        <option value="Clasificados" {{ $mensaje->vista == 'Clasificados' ? 'selected' : '' }}>Clasificados</option>
                        <option value="Parqueaderos" {{ $mensaje->vista == 'Parqueaderos' ? 'selected' : '' }}>Parqueaderos</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Mensaje</label>
                    <textarea name="mensaje" class="form-control" rows="3" required>{{ $mensaje->mensaje }}</textarea>
                </div>

                <button class="btn btn-warning">Actualizar</button>
                <a href="{{ route('mensajes_vistas.index') }}" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Nuevo Mensaje</h5>
        <div class="card-body">
            <form action="{{ route('mensajes_vistas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Vista</label>
                    <select class="form-control" name="vista" id="vista">
                        <option value="Trasteos">Trasteos</option>
                        <option value="Pagos">Pagos</option>
                        <option value="Emprendimientos">Emprendimientos</option>
                        <option value="Clasificados">Clasificados</option>
                        <option value="Parqueaderos">Parqueaderos</option>
                        <option value="Reservas">Reservas</option>
                        <option value="ZonaComun">ZonaComun</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Mensaje</label>
                    <textarea name="mensaje" class="form-control" rows="3" required></textarea>
                </div>

                <button class="btn btn-success">Guardar</button>
                <a href="{{ route('mensajes_vistas.index') }}" class="btn btn-secondary">Regresar</a>
            </form>

        </div>
    </div>
</div>
@endsection

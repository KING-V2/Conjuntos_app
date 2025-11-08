@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Reservas</h1>
        <div class="card-body">
            <h3>Reservas</h3>
            <table class="table table-bordered" style="overflow-x: auto;">
                <thead>
                    <tr>
                        <th>Zona</th><th>Usuario</th><th>Fecha</th><th>Hora</th><th>Estado</th><th>Comprobante</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservas as $r)
                    <tr>
                        <td>{{ $r->zona->nombre }}</td>
                        <td>{{ $r->usuario->name }}</td>
                        <td>{{ $r->fecha }}</td>
                        <td>{{ $r->hora_inicio }} - {{ $r->hora_fin }}</td>
                        <td>
                            @if($r->estado == 'Pendiente') <span class="badge bg-warning">Pendiente</span>
                            @elseif($r->estado == 'Aprobado') <span class="badge bg-success">Aprobado</span>
                            @else <span class="badge bg-danger">Rechazado</span>
                            @endif
                        </td>
                        <td>
                            @if($r->comprobante_pago)
                                <a target="_blank" href="{{ route('reservas.comprobante', $r) }}">Ver</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($r->estado == 'Pendiente')
                            <form action="{{ route('reservas.aprobar', $r) }}" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="estado" value="Aprobado">
                                <button class="btn btn-sm btn-success">Aprobar</button>
                            </form>
                            <form action="{{ route('reservas.aprobar', $r) }}" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="estado" value="Rechazado">
                                <button class="btn btn-sm btn-danger">Rechazar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $reservas->links() }}
        </div>
    </div>
</div>
@endsection
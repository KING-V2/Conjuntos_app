@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
      <h1 class="card-header">Reservas</h1>
      <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light"><tr>
                <th>Residente</th><th>Zona</th><th>Fecha</th><th>Hora</th><th>Estado</th><th>Comprobante</th><th>Acciones</th>
            </tr></thead>
            <tbody>
            @foreach($reservas as $r)
                <tr>
                    <td>{{ $r->usuario->name ?? 'N/A' }}</td>
                    <td>{{ $r->zona_comun->nombre ?? 'N/A' }}</td>
                    <td>{{ $r->fecha }}</td>
                    <td>{{ $r->hora_inicio }} - {{ $r->hora_fin }}</td>
                    <td>
                        <span class="badge bg-{{ $r->estado == 'Aprobado' ? 'success' : ($r->estado == 'Rechazado' ? 'danger' : 'warning') }}">
                            {{ $r->estado }}
                        </span>
                    </td>
                    <td>
                        @if($r->comprobante_pago)
                            <a href="{{ route('reservas.comprobante', $r->id) }}" target="_blank" class="btn btn-sm btn-info">Ver</a>
                        @else
                            <span class="text-muted">Sin</span>
                        @endif
                    </td>
                    <td style="min-width:220px">
                        @if($r->estado == 'Pendiente')
                        <form method="POST" action="{{ route('reservas.aprobar', $r->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success">Aprobar</button>
                        </form>

                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rechazarModal{{ $r->id }}">Rechazar</button>

                        <!-- Modal para rechazar -->
                        <div class="modal fade" id="rechazarModal{{ $r->id }}" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="POST" action="{{ route('reservas.rechazar', $r->id) }}">
                                @csrf
                                <div class="modal-header"><h5 class="modal-title">Rechazar reserva</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                  <div class="mb-3">
                                    <label>Motivo</label>
                                    <textarea name="descripcion_respuesta" class="form-control" required></textarea>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <button class="btn btn-danger">Enviar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        @else
                            <small class="text-muted">-</small>
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

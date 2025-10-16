@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Lista de respuestas</h5>
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            @foreach($meses as $mes)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-{{ strtolower($mes) }}" aria-controls="navs-tab-{{ strtolower($mes) }}" aria-selected="true">
                                        {{ $mes }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach($meses as $mes_actual)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="navs-tab-{{ strtolower($mes_actual) }}" role="tabpanel">
                                <div class="card-datatable table-responsive pt-0">
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th>Mes</th>
                                                <th>Título</th>
                                                <th>Descripción</th>
                                                <th>Respuesta admin</th>
                                                <th>Fecha Respuesta admin</th>
                                                <th>Usuario</th>
                                                <th>Casa</th>
                                                <th>Tipo Residente</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $respuestas_del_mes = collect($respuesta_foros)->filter(function($respuesta) use ($mes_actual) {
                                                    return $respuesta['mes'] === $mes_actual;
                                                });
                                            @endphp
                                            @if($respuestas_del_mes->isNotEmpty())
                                                @foreach($respuestas_del_mes as $respuesta_foro)
                                                    <tr>
                                                        <td>{{ $respuesta_foro['mes'] }}</td>
                                                        <td>{{ $respuesta_foro['titulo'] }}</td>
                                                        <td>{{ $respuesta_foro['descripcion'] }}</td>
                                                        <td>{{ $respuesta_foro['descripcion_admin'] }}</td>
                                                        <td>{{ $respuesta_foro['fecha_respuesta_admin'] }}</td>
                                                        <td>{{ $respuesta_foro['usuario'] ?? 'Sin Usuario' }}</td>
                                                        <td>{{ $respuesta_foro['casa'] }}</td>
                                                        <td>{{ $respuesta_foro['tipo_residente'] }}</td>
                                                        <td>
                                                            @if($respuesta_foro['descripcion_admin'] != '')
                                                                <b><i class="fa fa-check" style="font-size: 20px; color:green;"></i></b>
                                                            @else
                                                                <a href="{{ url('respuesta_foros_edit', ['id' => $respuesta_foro['id']]) }}" class="btn btn-info" alt="Responder">Responder</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">No hay respuestas para este mes.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

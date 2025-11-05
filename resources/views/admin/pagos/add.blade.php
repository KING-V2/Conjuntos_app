@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Pagos</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_pagos',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tipo de Pago *</label>
                        <select class="form-control" name="tipo_pago" id="tipo_pago" required>
                            @foreach($tipos_pagos as $tipos_pago)
                                <option value="{{ $tipos_pago }}">{{ $tipos_pago }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Casa</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            <option value="">-- Seleccione --</option>
                            @foreach($casas as $casa)
                                <option value="{{ $casa->id }}">{{ $casa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{ $mes }}">{{ $mes }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Adjunto Notificación *</label>
                        <input type="file" name="adjunto_notificacion" id="adjunto_notificacion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Descripción *</label>
                        <textarea name="comentario_admin" id="comentario_admin" class="form-control" required></textarea>
                    </div>

                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                {{-- 🔹 Nivel superior: pestañas de categorías --}}
                <div class="card-header border-bottom">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        @foreach($tipos_pagos as $tipo_pago)
                            @php
                                $tipo_id = strtolower(str_replace(' ', '-', $tipo_pago));
                            @endphp
                            <li class="nav-item">
                                <button
                                    type="button"
                                    class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    role="tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#categoria-{{ $tipo_id }}"
                                    aria-controls="categoria-{{ $tipo_id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                >
                                    {{ $tipo_pago }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 🔹 Contenido de cada categoría --}}
                <div class="tab-content mt-3">
                    @foreach($tipos_pagos as $tipo_pago)
                        @php
                            $tipo_id = strtolower(str_replace(' ', '-', $tipo_pago));
                        @endphp

                        <div
                            class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="categoria-{{ $tipo_id }}"
                            role="tabpanel"
                        >
                            {{-- 🔹 Pestañas de meses (segundo nivel) --}}
                            <div class="card-header border-bottom">
                                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                    @foreach($meses as $mes)
                                        @php
                                            $mes_id = strtolower($mes);
                                        @endphp
                                        <li class="nav-item">
                                            <button
                                                type="button"
                                                class="nav-link {{ $loop->first ? 'active' : ''}}"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#{{ $tipo_id }}-{{ $mes_id }}"
                                                aria-controls="{{ $tipo_id }}-{{ $mes_id }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                            >
                                                {{ $mes }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- 🔹 Contenido de cada mes --}}
                            <div class="tab-content">
                                @foreach($meses as $mes_actual)
                                    @php
                                        $mes_id = strtolower($mes_actual);
                                    @endphp
                                    <div
                                        class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="{{ $tipo_id }}-{{ $mes_id }}"
                                        role="tabpanel"
                                    >
                                        <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-bordered" style="overflow-x: auto;">
                                                <thead>
                                                    <tr>
                                                        <th>Casa</th>
                                                        <th>Tipo de Pago</th>
                                                        <th>Observacion Administrador</th>
                                                        <th>Adjunto Notificacion</th>
                                                        <th>Soporte Pago Residente</th>
                                                        <th>Administrador</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pagos->where('mes', $mes_actual)->where('tipo_pago', $tipo_pago) as $pago)
                                                        <tr>
                                                            <td>{{ $pago->casa->nombre ?? '-' }}</td>
                                                            <td>{{ $pago->tipo_pago ?? '-' }}</td>
                                                            <td>{{ $pago->comentario_admin ?? '-' }}</td>
                                                            <td>
                                                                @if($pago->adjunto_notificacion)
                                                                    <a href="{{ asset('storage/pagos/' . $pago->adjunto_notificacion) }}" target="_blank">Ver</a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($pago->adjunto)
                                                                    <a href="{{ asset('storage/pagos/' . $pago->adjunto) }}" target="_blank">Ver</a>
                                                                @endif
                                                            </td>
                                                            <td>{{ $pago->administrador->name ?? '-' }}</td>
                                                            <td>{{ $pago->estado ?? '-' }}</td>
                                                            <td>
                                                                @if($pago->estado == 'Pendiente')
                                                                    <a href="{{ url('pagos_edit', ['id' => $pago->id]) }}" class="btn btn-warning">
                                                                        <i class="fas fa-pencil"></i>
                                                                    </a>
                                                                    <a href="{{ url('pagos_delete', ['id' => $pago->id]) }}" class="btn btn-danger"
                                                                    onclick="return confirm('⚠️ ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.');">
                                                                    <i class="fas fa-trash"></i>
                                                                    </a>
                                                                @endif
                                                                @if($pago->estado == 'Aprobado')
                                                                    <i class="fas fa-check" style="color: green; font-size: 2em;"></i>
                                                                @endif
                                                                @if($pago->estado == 'Rechazado')
                                                                    <i class="fas fa-xmark" style="color: red; font-size: 2em;"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
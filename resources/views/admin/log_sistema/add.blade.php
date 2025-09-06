@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header"> Log Sistema</h5>
        <div class="card-body">
            <div class="row">
                <h5 class="card-header">Listado</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Accion</th>
                            <th>Usuario</th>
                            <th>Datos</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if($log_sistema)
                                @foreach($log_sistema as $log)
                                <tr>
                                    <td>{{ $log->accion }}</td>
                                    <td>{{ $log->usuario->name }}</td>
                                    <td style="min-width:320px; max-width:520px; white-space:normal;">
                                        @php
                                            $raw = $log->datos;
                                            $decoded = null;

                                            // 1. Si es string, intentar decodificar
                                            if (is_string($raw)) {
                                                $decoded = json_decode($raw, true);

                                                // 2. Si la primera decodificación devuelve string, intentar segunda decodificación
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                            } 
                                            // 3. Si ya viene como array u objeto
                                            elseif (is_array($raw) || is_object($raw)) {
                                                $decoded = (array) $raw;
                                            }

                                            // Verificar si realmente es un array válido
                                            $isJson = is_array($decoded) && !empty($decoded);
                                        @endphp

                                        @if($isJson)
                                            <table class="table table-sm table-borderless mb-0">
                                                <tbody>
                                                    @foreach($decoded as $key => $value)
                                                        <tr>
                                                            <th style="width:30%; vertical-align: top; background:#f8f9fa;">
                                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                            </th>
                                                            <td style="vertical-align: top;">
                                                                @if(is_array($value))
                                                                    <pre class="mb-0 small">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <pre class="mb-0 small">{{ $raw }}</pre>
                                        @endif
                                    </td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h4>No hay registros</h4>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

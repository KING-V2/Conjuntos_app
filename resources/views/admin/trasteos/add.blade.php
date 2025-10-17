@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Solicitud Trasteo Administración</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_trasteos',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{$mes}}">{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Residente</label>
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $usuarios as $usuario )
                                <option value="{{ $usuario->usuario->id }}">{{ $usuario->usuario->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">fecha</label>
                        <input class="form-control" type="date" id="fecha" name="fecha" placeholder="fecha" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">hora</label>
                        <input class="form-control" type="time" id="hora" name="hora" placeholder="Hora" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">Descripcion Solicitud</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="5" placeholder="descripcion"></textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Guardar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card text-center mb-3">
                        <div class="card-header border-bottom">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                @foreach($meses as $mes)
                                    @if(isset($trasteosPorMes[$mes])) <!-- Solo mostrar meses con datos -->
                                        <li class="nav-item">
                                            <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-{{strtolower($mes)}}" aria-controls="navs-tab-{{strtolower($mes)}}" aria-selected="true">{{$mes}}</button>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content">
                            @foreach($meses as $mes_actual)
                                @if(isset($trasteosPorMes[$mes_actual]))
                                    <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="navs-tab-{{ strtolower($mes_actual)}}" role="tabpanel">
                                        <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Solicitante</th>
                                                        <th>Casa</th>
                                                        <th>Fecha generacion solicitud trasteo</th>
                                                        <th>Fecha solicitud trasteo</th>
                                                        <th>Hora solicitud trasteo</th>
                                                        <th>Descripción solicitud</th>
                                                        <th>Administrador</th>
                                                        <th>Respuesta Administrador</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($trasteosPorMes[$mes_actual] as $trasteo)
                                                        <tr>
                                                            <td>{{ $trasteo['id'] }}</td>
                                                            <td>{{ $trasteo['solicitante'] }}</td>
                                                            <td>{{ $trasteo['casa'] }}</td>
                                                            <td>{{ $trasteo['fecha_solicitud'] }}</td>
                                                            <td>{{ $trasteo['fecha'] }}</td>
                                                            <td>{{ $trasteo['hora'] }}</td>
                                                            <td>{{ $trasteo['descripcion'] }}</td>
                                                            <td>{{ $trasteo['administrador'] }}</td>
                                                            <td>{{ $trasteo['descripcion_respuesta'] }}</td>
                                                            <td>{{ $trasteo['estado'] }}</td>
                                                            <td>
                                                                @if($trasteo['estado'] == 'Aprobado')
                                                                    <i class="fa fa-check" style="font-size:22px; color:green;"></i>
                                                                @else
                                                                    <a href="{{ url('trasteos_edit', ['id' => $trasteo['id']]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

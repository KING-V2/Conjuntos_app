@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actividades</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_actividades',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Hecha">Hecha</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="descripcion"></textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
             <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            @foreach($meses as $mes)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-{{strtolower($mes)}}" aria-controls="navs-tab-{{strtolower($mes)}}" aria-selected="true">{{$mes}}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach($meses as $mes_actual)
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="navs-tab-{{ strtolower($mes_actual)}}" role="tabpanel">
                                <div class="card-datatable table-responsive pt-0">
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Id </th>
                                                <th> fecha ejecucion</th>
                                                <th> descripcion </th>
                                                <th> estado </th>
                                                <th> actualizacion </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $actividades->where('mes', $mes_actual ) as $actividad )
                                                <tr>
                                                    <td>{{ $actividad->id }}</td>
                                                    <td>
                                                        <p>{{$actividad->fecha }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{$actividad->descripcion }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{$actividad->estado }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{$actividad->updated_at ?? '-' }}</p>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('actividades_edit',[ 'id' =>  $actividad->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('actividades_delete',[ 'id' =>  $actividad->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?');"><i class="fa fa-trash"></i></a>
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
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Empleado</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_empleados',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Puesto</label>
                        <select class="form-control" name="puesto" id="puesto" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($puestos as $puesto)
                                <option value="{{$puesto}}">{{ ucfirst($puesto)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" accept="image/jpg, image/png, image/jpeg"/>
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
                            @foreach($puestos as $puesto)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : ''}}" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-{{$puesto}}" aria-controls="navs-tab-{{$puesto}}" aria-selected="true">{{ucfirst($puesto)}}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                            @foreach($puestos as $puesto)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : ''}}" id="navs-tab-{{$puesto}}" role="tabpanel">
                                    <div class="card-datatable table-responsive pt-0">
                                        @if( $empleados->where('estado',$puesto ) )
                                            <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Nombre </th>
                                                    <th> Cargo </th>
                                                    <th> Foto </th>
                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $empleados->where('puesto',$puesto ) as $empleado )
                                                    <tr>
                                                        <td>{{ $empleado->id }}</td>
                                                        <td>{{ $empleado->nombre }}</td>
                                                        <td>{{ ucfirst($empleado->puesto) }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/empleados').'/'.$empleado->foto }}" alt="" width="40%">
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('empleados_edit',[ 'id' =>  $empleado->id ]) }}" class="btn btn-info mb-2"><i class="material-icons-outlined">editar</i></a>
                                                            <a href="{{ url('empleados_delete',[ 'id' =>  $empleado->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');"><i class="material-icons-outlined">borrar</i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        @else
                                            <h4>Sin Administradores</h4>
                                        @endif
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
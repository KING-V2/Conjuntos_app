@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Datos del cliente</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('clientes/' . $clientes->id) }}">
            @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre del cliente</label>
                        <input class="form-control" type="text" id="nombres" name="nombres" value="{{$clientes->nombres}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Numero de Documento</label>
                        <input class="form-control" type="number" id="numero_documento" name="numero_documento" value="{{$clientes->numero_documento}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{$clientes->email}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">celular</label>
                        <input class="form-control" type="number" id="celular" name="celular" value="{{$clientes->celular}}" />
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
</div>
<hr>

<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Creación de vehiculo</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_vehiculos',[]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="cliente_id" value="{{ $clientes->id }}">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Placa del vehiculo</label>
                        <input class="form-control" type="text" id="placa" name="placa" placeholder="BQP203" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Marca</label>
                        <input class="form-control" type="text" id="marca" name="marca" placeholder="Mazda, Toyota, Chevrolet" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="">-- Seleccione --</option>
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="camion">Camion</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="tab-content">
                            @foreach($clientes->vehiculos as $vehiculo)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : ''}}" id="navs-tab-{{$vehiculo}}" role="tabpanel">
                                    <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Cliente </th>
                                                    <th> PLaca </th>
                                                    <th> Marca </th>
                                                    <th> Tipo </th>
                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($clientes->vehiculos as $vehiculo )
                                                    <tr>
                                                        <td>{{ $vehiculo->id }}</td>
                                                        <td>{{ $vehiculo->cliente_id }}</td>
                                                        <td>{{ $vehiculo->placa }}</td>
                                                        <td>{{ $vehiculo->marca }}</td>
                                                        <td>{{ $vehiculo->tipo }}</td>
                                                        <td>
                                                            <a href="{{ url('vehiculos_edit',[ 'id' =>  $vehiculo->id ]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('vehiculos_delete', $vehiculo->id) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este vehiculo?');"><i class="fa fa-trash"></i></a>
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
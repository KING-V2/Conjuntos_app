@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado de clientes</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_clientes',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombres</label>
                        <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Juan Perez" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Numero de Documento</label>
                        <input class="form-control" type="number" id="numero_documento" name="numero_documento" placeholder="123456789" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="usuario@gmail.com" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Celular</label>
                        <input class="form-control" type="number" id="celular" name="celular" placeholder="3012345678" value=""/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="tab-content">
                            @foreach($clientes as $cliente)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : ''}}" id="navs-tab-{{$cliente}}" role="tabpanel">
                                    <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Nombre </th>
                                                    <th> Numero de Documento </th>
                                                    <th> Email </th>
                                                    <th> Celular </th>
                                                    <th> Estado </th>
                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($clientes as $cliente )
                                                    <tr>
                                                        <td>{{ $cliente->id }}</td>
                                                        <td>{{ $cliente->nombres }}</td>
                                                        <td>{{ $cliente->numero_documento }}</td>
                                                        <td>{{ $cliente->email }}</td>
                                                        <td>{{ $cliente->celular }}</td>
                                                        <td>
                                                            <span class="btn {{ $cliente->estado == 1 ? 'btn btn-success' : 'btn btn-danger' }}">
                                                                {{ $cliente->estado == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('clientes',[ 'id' =>  $cliente->id ]) }}" class="btn btn-dark mb-2"><i class="fa fa-car"></i></a>
                                                            <a href="{{ url('clientes_edit',[ 'id' =>  $cliente->id ]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('clientes_delete', $cliente->id) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"><i class="fa fa-trash"></i></a>
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
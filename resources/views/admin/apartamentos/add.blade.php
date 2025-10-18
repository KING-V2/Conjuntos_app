@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Crear Apartamento</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_apartamentos',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">codigo</label>
                        <input class="form-control" type="text" id="codigo" name="codigo" placeholder="codigo" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Asignada">Asignada</option>
                            <option value="Arriendo">Arriendo</option>
                            <option value="Venta">Venta</option>
                            <option value="Libre">Libre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Bloques</label>
                        <select class="form-control" name="bloque_id" id="bloque_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $bloques as $bloque )
                                <option value="{{$bloque->id }}">{{$bloque->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> bloque </th>
                                    <th> codigo </th>
                                    <th> Nombre </th>
                                    <th> Estado </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $apartamentos as $apartamento )
                                    <tr>
                                        <td>{{ $apartamento->id }}</td>
                                        <td>{{ $apartamento->bloque->nombre }}</td>
                                        <td>{{ $apartamento->codigo }}</td>
                                        <td>{{ $apartamento->nombre }}</td>
                                        <td>{{ $apartamento->estado }}</td>
                                        <td>
                                            <a href="{{ url('apartamentos_edit',[ 'id' =>  $apartamento->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('apartamentos_delete',[ 'id' =>  $apartamento->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este apartamento?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

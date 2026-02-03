@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Crear espacio parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_espacios',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Numero</label>
                        <input class="form-control" type="text" id="numero" name="numero" placeholder="EJ: A1 - B1" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="disponible">Disponible</option>
                            <option value="ocupado">Ocupado</option>
                            <option value="reservado">Reservado</option>
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
                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-bordered" style="overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Numero </th>
                                            <th> Estado </th>
                                            <th> Opciones </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach( $espacios as $espacio )
                                                <tr>
                                                    <td>{{ $espacio->id }}</td>
                                                    <td>{{ $espacio->numero }}</td>
                                                    <td>{{ $espacio->estado }}</td>
                                                    <td>
                                                        <a href="{{ url('espacios_edit',[ 'id' =>  $espacio->id ]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('espacios_delete', $espacio->id) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarifa?');"><i class="fa fa-trash"></i></a>
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
</div>
@endsection
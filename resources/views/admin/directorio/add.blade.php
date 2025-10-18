@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Directorio</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_directorios',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Telefono</label>
                        <input class="form-control" type="text" id="telefono" name="telefono" placeholder="telefono" value=""/>
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
                                    <th> Nombre </th>
                                    <th> Telefono </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $directorios as $directorio )
                                    <tr>
                                        <td>{{ $directorio->id }}</td>
                                        <td>{{ $directorio->nombre }}</td>
                                        <td>{{ $directorio->telefono }}</td>
                                        <td>
                                            <a href="{{ url('directorios_edit',[ 'id' =>  $directorio->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('directorios_delete',[ 'id' =>  $directorio->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este directorio?');"><i class="fa fa-trash"></i></a>
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
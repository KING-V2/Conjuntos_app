@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Cargue Categoria Parqueadero</h5>
        <div class="card-body">
            <form action="{{ url('cargar_categoria_vehiculo') }}" method="POST">
                @csrf
                <div class="row">                    
                    <div class="col-sm-12 col-md-3">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" class="form-control" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="limite">Límite:</label>
                        <input type="number" name="limite" id="limite" class="form-control" required>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="valor">Valor:</label>
                        <input type="number" name="valor" id="valor" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Guardar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Límite</th>
                                <th>Valor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoria_vehiculos as $categoria_vehiculo)
                                <tr>
                                    <td>{{ $categoria_vehiculo->numero }}</td>
                                    <td>{{ $categoria_vehiculo->nombre }}</td>
                                    <td>{{ $categoria_vehiculo->limite }}</td>
                                    <td>{{ $categoria_vehiculo->valor }}</td>
                                    <td>
                                        <a href="{{ url('categoria_vehiculo_edit', $categoria_vehiculo->id) }}" class="btn btn-warning"> <i class="material-icons-outlined">editar</i> </a>
                                        <form action="{{ url('categoria_vehiculo_delete', []) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input class="form-control" type="hidden" id="categoria_vehiculo_id" name="categoria_vehiculo_id" placeholder="categoria_vehiculo_id" value="{{$categoria_vehiculo->id}}"/>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"><i class="material-icons-outlined">borrar</i></button>
                                        </form>
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
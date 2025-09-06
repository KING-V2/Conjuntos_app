@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Clasificados</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_clasificados',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">casa</label>
                        <select class="form-control" name="casa_id" id="casa_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $casas as $casa )
                                <option value="{{$casa->id }}">{{$casa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Alquiler">Alquiler</option>
                            <option value="Venta">Venta</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Foto</label>
                        <input class="form-control" type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Información Adicional</label>
                        <input class="form-control" type="text" id="adicional" name="adicional" placeholder="Información adicional" value=""/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="7" type="text" id="descripcion" name="descripcion" placeholder="Descripción del inmueble"></textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card text-center mb-3">
                        <div class="card-header border-bottom">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-alquiler" aria-controls="navs-tab-alquiler" aria-selected="true">Alquiler</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-venta" aria-controls="navs-tab-venta" aria-selected="false">Venta</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-tab-alquiler" role="tabpanel">
                                <div class="card-datatable table-responsive pt-0">
                                    @if( $clasificados->where('estado','Alquiler') )
                                        <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> estado </th>
                                                    <th> conjunto </th>
                                                    <th> casa </th>
                                                    <th> descripcion </th>
                                                    <th> foto </th>
                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $clasificados->where('estado','Alquiler') as $clasificado )
                                                    <tr>
                                                        <td>{{ $clasificado->id }}</td>
                                                        <td>{{ $clasificado->estado }}</td>
                                                        <td>{{ $clasificado->casa->conjunto->nombre }}</td>
                                                        <td>{{ $clasificado->casa->nombre }}</td>
                                                        <td>{{ Str::limit($clasificado->descripcion, 50) }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/clasificados').'/'.$clasificado->foto }}" alt="" width="400px;">
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('clasificados_edit',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                                            <a href="{{ url('clasificados_borrar',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este clasificado?');"><i class="material-icons-outlined">borrar</i></a>
                                                            <a href="{{ url('galeria_de_clasificado',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-success"><i class="material-icons-outlined">visibility</i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h4>Sin Alquileres</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-tab-venta" role="tabpanel">
                                <div class="card-datatable table-responsive pt-0">
                                    @if( $clasificados->where('estado','Venta') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Id </th>
                                                <th> estado </th>
                                                <th> conjunto </th>
                                                <th> casa </th>
                                                <th> descripcion </th>
                                                <th> foto </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $clasificados->where('estado','Venta') as $clasificado )
                                                <tr>
                                                    <td>{{ $clasificado->id }}</td>
                                                    <td>{{ $clasificado->estado }}</td>
                                                    <td>{{ $clasificado->casa->conjunto->nombre }}</td>
                                                    <td>{{ $clasificado->casa->nombre }}</td>
                                                    <td>{{ Str::limit($clasificado->descripcion, 50) }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/clasificados').'/'.$clasificado->foto }}" alt="" width="400px;">
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('clasificados_edit',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('clasificados_borrar',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger"><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_de_clasificado',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <h4>Sin Clasificados</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
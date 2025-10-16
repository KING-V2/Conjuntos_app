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
                        <input class="form-control" type="text" id="casa" name="casa" placeholder="casa"/>
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
                        <label for="form" class="form-label">Whatsapp</label>
                        <input class="form-control" type="text" id="whatsapp" name="whatsapp" placeholder="whatsapp"/>
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
                                                    <th> casa </th>
                                                    <th> whatsapp </th>
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
                                                        <td>{{ $clasificado->casa }}</td>
                                                        <td>
                                                            <a href="https://wa.me/57{{ $clasificado->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                        </td>
                                                        <td>{{ Str::limit($clasificado->descripcion, 50) }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/clasificados').'/'.$clasificado->foto }}" alt="" width="400px;">
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('clasificados_edit',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('clasificados_borrar',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este clasificado?');"><i class="fa fa-trash"></i></a>
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
                                                <th> casa </th>
                                                <th> whatsapp </th>
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
                                                    <td>{{ $clasificado->casa }}</td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $clasificado->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>{{ Str::limit($clasificado->descripcion, 50) }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/clasificados').'/'.$clasificado->foto }}" alt="" width="400px;">
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('clasificados_edit',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('clasificados_borrar',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
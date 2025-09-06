@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">PQRS</h1>
        <div class="card-body">
            @if ( $foros->isEmpty() )
                <form method="post" action="{{ url('cargar_foros',[]) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <label for="form" class="form-label">titulo</label>
                            <input class="form-control" type="text" id="titulo" name="titulo" placeholder="titulo" value=""/>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="form" class="form-label">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="">-- Seleccione --</option>
                                <option value="Activo" selected>Activo</option>
                                <option value="No Activo">No Activo</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4" hidden>
                            <label for="form" class="form-label">Mes</label>
                            <select class="form-control" name="mes" id="mes">
                                @foreach($meses as $mes)
                                    <option value="{{$mes}}">{{$mes}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <textarea class="form-control" rows="3" type="text" id="descripcion" name="descripcion" placeholder="Descripcion Pqr"></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success">Cargar</button>
                </form>
            @endif
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> creado </th>
                                    <th> Titulo </th>
                                    <th> Mes </th>
                                    <th> Descripcion </th>
                                    <th> Estado </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $foros as $foro )
                                    <tr>
                                        <td>{{ $foro->id }}</td>
                                        <td>{{ $foro->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $foro->titulo }}</td>
                                        <td>{{ $foro->mes }}</td>
                                        <td><p>{{$foro->descripcion }}</p></td>
                                        <td>{{ $foro->estado }}</td>
                                        <td>
                                            <a href="{{ url('foros_edit',[ 'id' =>  $foro->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">edit</i></a>
                                            <!-- <a href="{{ url('foros_delete',[ 'id' =>  $foro->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este foro y sus respuestas?');"><i class="material-icons-outlined">delete</i></a> -->
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
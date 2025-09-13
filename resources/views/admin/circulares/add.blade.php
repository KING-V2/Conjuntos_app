@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Agregar Circulares</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_circulares',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Titulo de la circular" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes">
                            <option value="">-- Seleccione --</option>
                            @foreach($meses as $mes)
                                <option value="{{$mes}}">{{$mes}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" accept=".pdf" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label for="form" class="form-label">Descripcion Archivo</label>
                        <textarea class="form-control" type="text" id="descripcion" name="descripcion" placeholder="descripcion archivo"></textarea>
                    </div>
                </div>
                <br>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card text-center mb-3">
                        <div class="card-header border-bottom">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                @foreach($meses as $mes)
                                    <li class="nav-item">
                                        <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-{{strtolower($mes)}}" aria-controls="navs-tab-{{strtolower($mes)}}" aria-selected="true">{{$mes}}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach($meses as $mes_actual)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="navs-tab-{{ strtolower($mes_actual)}}" role="tabpanel">
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Mes </th>
                                                    <th> Titulo </th>
                                                    <th> Archivo </th>
                                                    <th> Descripcion </th>
                                                    <th> Publicacion</th>
                                                    <th> Actualizacion</th>
                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $circulares->where('mes', $mes_actual ) as $circular )
                                                    <tr>
                                                        <td>{{ $circular->id }}</td>
                                                        <td>{{ $circular->mes }}</td>
                                                        <td>{{ $circular->titulo }}</td>
                                                        <td>
                                                            <a href="{{ asset('storage/circulares').'/'.$circular->archivo }}" alt="" width="40%">{{$circular->archivo}}</a>
                                                        </td>
                                                        <td>
                                                            <p>{{$circular->descripcion }}</p>
                                                        </td>
                                                        <td>
                                                            {{ $circular->created_at }}
                                                        </td>
                                                        <td>
                                                            {{ $circular->updated_at }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('circulares_edit',[ 'id' =>  $circular->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('circulares_delete',[ 'id' =>  $circular->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta circular?');"><i class="fa fa-trash"></i></a>
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
</div>
@endsection
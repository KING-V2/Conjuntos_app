@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header"> Configuracion Cargue Archivos</h5>
        <div class="card-body">
            @if( count($configs) == 0 )
            <form method="post" action="{{ url('guardar_config',[]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="formFile" class="form-label">Ext Audio</label>
                        <input class="form-control" type="text" id="extension_audio" name="extension_audio" />
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="formFile" class="form-label">Tamanio Audio</label>
                        <input class="form-control" type="text" id="tamanio_audio" name="tamanio_audio" />
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="formFile" class="form-label">Ext Documento</label>
                        <input class="form-control" type="text" id="extension_documento" name="extension_documento" />
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="formFile" class="form-label">Tamanio DOcumento</label>
                        <input class="form-control" type="text" id="tamanio_documento" name="tamanio_documento" />
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            @endif
            <div class="row">
                <h5 class="card-header">Configuracion</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Extension Audio</th>
                            <th>Tamanio Audio</th>
                            <th>Extencion Doc</th>
                            <th>Tamanio Doc</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if( $configs )
                        @foreach( $configs as $config )
                            <tr>
                                <td>{{$config->extension_audio}}</td>
                                <td>{{$config->tamanio_audio	}}</td>
                                <td>{{$config->extension_documento }}</td>
                                <td>{{$config->tamanio_documento }}</td>
                                <td>{{$config->created_at}}</td>
                                <td>{{$config->updated_at}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:openModalConfig({{$config->id}});"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <h4>No hay registros</h4>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.edit_config')
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/configs.js') }}"></script>
@endsection
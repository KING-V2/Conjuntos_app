@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header"> Cargue Archivos Audio</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_audio_archivos',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="formFile" class="form-label">Adjuntar Archivos</label>
                    <input class="form-control" type="file" id="fileAudio" name="fileAudio" />
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <div class="row">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre Original</th>
                            <th>Nombre</th>
                            <th>Extension</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if( $audios )
                                @foreach( $audios as $audio )
                                <tr>
                                    <td>{{$audio->nombre_original}}</td>
                                    <td>{{$audio->nombre}}</td>
                                    <td>{{$audio->extension}}</td>
                                    <td>{{$audio->created_at}}</td>
                                    <td>{{$audio->updated_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:openModalArchivoAudio({{$audio->id}});"
                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                >
                                                <a class="dropdown-item" target="_blank" href="{{ asset('storage_audios')}}/{{$audio->nombre}}.{{$audio->extension}}"
                                                ><i class="fa fa-eye me-1"></i> Ver</a
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
    <br>
    <div class="card">
        <h5 class="card-header">Cargue Archivos Otros</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_otros_archivos',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="formFile" class="form-label">Adjuntar Archivos</label>
                    <input class="form-control" type="file" id="fileOther" name="fileOther"/>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <div class="row">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre Original</th>
                            <th>Nombre</th>
                            <th>Extension</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach( $files as $file )
                                <tr>
                                    <td>{{$file->nombre_original}}</td>
                                    <td>{{$file->nombre}}</td>
                                    <td>{{$file->extension}}</td>
                                    <td>{{$file->created_at}}</td>
                                    <td>{{$file->updated_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:openModalArchivo({{$file->id}});"
                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                >
                                                <a class="dropdown-item" target="_blank" href="{{ asset('storage_files')}}/{{$file->nombre}}.{{$file->extension}}"
                                                ><i class="fa fa-eye me-1"></i> Ver</a
                                                >
                                            </div>
                                        </div>
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
@include('admin.modals.edit_audio')
@include('admin.modals.edit_file')
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
    <script src="{{ asset('assets/js/audios/files.js') }}"></script>
@endsection
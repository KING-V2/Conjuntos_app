@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Galeria Emprendimiento</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_galeria_emprendimiento',[]) }}" enctype="multipart/form-data">
                @if( isset( $emprendimiento_id ) )
                    <input class="form-control" type="hidden" id="emprendimiento_id" name="emprendimiento_id" value="{{$emprendimiento_id}}"/>
                @endif
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Imágenes</label>
                        <input class="form-control" type="file" id="imagen" name="imagenes[]" multiple />
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="datatables-basic-files table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Imagen </th>
                                    <th> opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $emprendimientos as $g_emprendimiento )
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/galeria_emprendimientos').'/'.$g_emprendimiento->imagen }}" alt="" width="40%">
                                        </td>
                                        <td>
                                            <!-- <a href="{{ url('galeria_emprendimiento_edit',[ 'id' =>  $g_emprendimiento->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a> -->
                                            <a href="{{ url('galeria_emprendimiento_delete',[ 'id' =>  $g_emprendimiento->id ]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');"><i class="fa fa-trash"></i></a>
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
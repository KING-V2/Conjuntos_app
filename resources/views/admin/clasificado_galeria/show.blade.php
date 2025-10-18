@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1 class="card-header">Clasificado Galeria</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_clasificado_galeria',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="form" class="form-label">Imagenes</label>
                        <input class="form-control" type="file" id="imagen" name="imagen[]" accept=".jpg, .jpeg, .png" multiple/>
                    </div>
                    <div class="col-sm-12 col-md-6">
                    <input class="form-control" type="hidden" id="clasificado_id" name="clasificado_id" value="{{$clasificado_id}}"/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="card-datatable table-responsive pt-0">
                @if( $galeria )
                    <table class="table table-bordered" style="overflow-x: auto;">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> apartamento </th>
                                <th> foto </th>
                                <th> Opciones </th>
                            </tr>
                        </thead>    
                        <tbody>
                            @foreach( $galeria as $clasificado )
                                <tr>
                                    <td>{{ $clasificado->id }}</td>
                                    <td>{{ $clasificado->clasificado->casa->nombre }}</td>
                                    <td>
                                        <img src="{{ asset('storage/clasificado_galeria').'/'.$clasificado->imagen }}" alt="" width="50%">
                                    </td>
                                    <td>
                                        <!-- <a href="{{ url('clasificados_edit',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a> -->
                                        <a href="{{ url('clasificado_galeria_delete',[ 'id' =>  $clasificado->id ]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Sin Galeria</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

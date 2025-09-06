@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Galeria Emprendimiento</h5>
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="datatables-basic-files table table-bordered" style="overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th> Imagen </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $emprendimientos as $g_emprendimiento )
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/galeria_emprendimientos').'/'.$g_emprendimiento->imagen }}" alt="" width="40%">
                                        </td>
                                        <td>
                                            <a href="{{ url('galeria_emprendimiento_edit',[ 'id' =>  $g_emprendimiento->id ]) }}" class="btn btn-info"><i class="material-icons-outlined">editar</i></a>
                                            <a href="{{ url('galeria_emprendimiento_delete',[ 'id' =>  $g_emprendimiento->id ]) }}" class="btn btn-danger"><i class="material-icons-outlined">borrar</i></a>
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
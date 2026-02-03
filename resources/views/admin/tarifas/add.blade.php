@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado de tarifas</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_tarifas',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Nombre de la tarifa</label>
                        <select class="form-control" name="nombre" id="nombre">
                            <option value="">-- Seleccione --</option>
                            <option value="regular">Regular</option>
                            <option value="nocturna">Nocturna</option>
                            <option value="fin_de_semana">Fin de semana</option>
                            <option value="festivos">Festivo</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Tipo de tarifa</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="">-- Seleccione --</option>
                            <option value="Por_hora">Por hora</option>
                            <option value="por_dia">Por dia</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Costo</label>
                        <input class="form-control" type="text" id="costo" name="costo" placeholder="5.000-10.000" value=""/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Minutos de Gavela</label>
                        <input class="form-control" type="text" id="minutos_gavela" name="minutos_gavela" placeholder="10-20 Min" value=""/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="tab-content">
                            @foreach($tarifas as $tarifa)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : ''}}" id="navs-tab-{{$tarifa}}" role="tabpanel">
                                    <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-bordered" style="overflow-x: auto;">
                                            <thead>
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Nombre </th>
                                                    <th> Tipo </th>
                                                    <th> Costo </th>
                                                    <th> Minutos de Gavela </th>

                                                    <th> Opciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tarifas as $tarifa )
                                                    <tr>
                                                        <td>{{ $tarifa->id }}</td>
                                                        <td>{{ $tarifa->nombre }}</td>
                                                        <td>{{ $tarifa->tipo }}</td>
                                                        <td>{{ $tarifa->costo }}</td>
                                                        <td>{{ $tarifa->minutos_gavela }}</td>
                                                        <td>
                                                            <a href="{{ url('tarifas_edit',[ 'id' =>  $tarifa->id ]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('tarifas_delete', $tarifa->id) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarifa?');"><i class="fa fa-trash"></i></a>
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
@endsection
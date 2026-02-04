@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado de tickets</h5>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_tickets',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Espacio</label>
                        <select class="form-control" name="espacio_id" id="espacio_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($espacios as $espacio)
                                <option value="{{$espacio->id}}" >{{ $espacio->numero}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Cliente</label>
                        <select class="form-control" name="cliente_id" id="cliente_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}" >{{ $cliente->nombres}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Vehiculo</label>
                        <select class="form-control" name="vehiculo_id" id="vehiculo_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{$vehiculo->id}}" >{{ $vehiculo->placa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Tarifa</label>
                        <select class="form-control" name="tarifa_id" id="tarifa_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($tarifas as $tarifa)
                                <option value="{{$tarifa->id}}" >{{ $tarifa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Seleccionar Usuario</label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" >{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Codigo del Ticket:</label>
                        <input class="form-control" type="number" id="codigo_ticket" name="codigo_ticket"  value=""/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Fecha de Ingreso:</label>
                        <input class="form-control" type="datetime-local" id="fecha de ingreso" name="fecha de ingreso" value=""/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="tab-content">
                            @foreach($ticketes as $ticket)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : ''}}" id="navs-tab-{{$ticket}}" role="tabpanel">
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
                                                @foreach($ticketes as $ticket)
                                                    <tr>
                                                        <td>{{ $ticket->id }}</td>
                                                        <td>{{ $ticket->nombre }}</td>
                                                        <td>{{ $ticket->tipo }}</td>
                                                        <td>{{ $ticket->costo }}</td>
                                                        <td>{{ $ticket->minutos_gavela }}</td>
                                                        <td>
                                                            <a href="{{ url('ticketes_edit',[ 'id' =>  $ticket->id ]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ url('ticketes_delete', $ticket->id) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarifa?');"><i class="fa fa-trash"></i></a>
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
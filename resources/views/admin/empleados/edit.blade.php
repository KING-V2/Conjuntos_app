@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Empleado</h5>
        <div class="card-body">
            <form method="post" action="{{ url('empleados_update',[]) }}" enctype="multipart/form-data" />
                <input class="form-control" type="hidden" id="id_empleado" name="id_empleado" value="{{$empleado->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="{{$empleado->nombre}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Puesto</label>
                        <select class="form-control" name="puesto" id="puesto" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($puestos as $puesto)
                                <option value="{{$puesto}}" {{ $empleado->puesto ==  $puesto ? 'selected' : '' }}>{{ucfirst($puesto)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" />
                    </div>
                </div>
                <hr>
                <div class="mb-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('empleados')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
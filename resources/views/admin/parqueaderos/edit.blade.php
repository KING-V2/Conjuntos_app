@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Parqueadero</h5>
        <div class="card-body">
            <form method="post" action="{{ url('parqueaderos_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="parqueadero_id" name="parqueadero_id" placeholder="parqueadero_id" value="{{$parqueaderos->id}}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre" value="{{$parqueaderos->nombre}}" autofocus/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection
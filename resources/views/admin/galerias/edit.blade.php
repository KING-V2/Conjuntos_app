@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Galeria</h5>
        <div class="card-body">
            <form method="post" action="{{ url('galeria_conjunto_update',[]) }}" enctype="multipart/form-data">
            <input class="form-control" type="hidden" id="id_galeria" name="id_galeria" value="{{$galeria->id}}" />
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">descripcion</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$galeria->descripcion}}" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">iamgen</label>
                        <input class="form-control" type="file" id="iamgen" name="iamgen" />
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <button class="btn btn-warning">Actualizar</button>
                    <a href="{{ url('galeria_conjunto')}}" class="btn btn-danger">Cancelar</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
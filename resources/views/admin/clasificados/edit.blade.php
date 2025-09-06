@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Clasificado</h5>
        <div class="card-body">
            <form method="post" action="{{ url('clasificados_update',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="clasificado_id" name="clasificado_id" value="{{ $clasificado->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Apartamento</label>
                        <select class="form-control" name="apartamento_id" id="apartamento_id">
                            <option value="">-- Seleccione --</option>
                            @foreach( $apartamentos as $apartamento )
                                <option value="{{$apartamento->id }}" {{ $clasificado->apartamento->id == $apartamento->id ? 'selected' : '' }}>{{$apartamento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">-- Seleccione --</option>
                            <option value="Alquiler" {{ $clasificado->estado == "Alquiler" ? 'selected' : '' }}>Alquiler</option>
                            <option value="Permuta" {{ $clasificado->estado == "Permuta" ? 'selected' : '' }}>Permuta</option>
                            <option value="Venta" {{ $clasificado->estado == "Venta" ? 'selected' : '' }}>Venta</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Foto</label>
                        <input class="form-control" type="file" id="foto" name="foto" />
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Informacion Adicional</label>
                        <input class="form-control" type="text" id="adicional" name="adicional" placeholder="Informacion adicional" value="{{ $clasificado->adicional }}"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <textarea class="form-control" rows="7" type="text" id="descripcion" name="descripcion" placeholder="descripcion del inmueble"> {{$clasificado->descripcion }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="mb-12">
                        <button class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="mb-12">
                <a href="{{ url('clasificados')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection
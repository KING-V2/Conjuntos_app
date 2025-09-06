@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Actualizar Tarifa</h5>
        <div class="card-body">
        <form method="post" action="{{ url('tarifas_conjunto_update',[]) }}">
                {{ csrf_field() }}
                <input class="form-control" type="hidden" id="tarifa_id" name="tarifa_id" value="{{ $tarifasConjunto->id }}"/>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">descripcion</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="descripcion de la tarifa" value="{{ $tarifasConjunto->descripcion }}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">valor</label>
                        <input class="form-control" type="text" id="valor" name="valor" placeholder="valor" value="{{ $tarifasConjunto->valor }}"/>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="administrativa" {{ $tarifasConjunto->tipo == 'administrativa' ? 'selected' : ''  }} >administrativa</option>
                            <option value="parqueadero_visitantes" {{ $tarifasConjunto->tipo == 'parqueadero_visitantes' ? 'selected' : ''  }} >parqueadero_visitantes</option>
                            <option value="multa" {{ $tarifasConjunto->tipo == 'multa' ? 'selected' : ''  }} >multa</option>
                            <option value="otros" {{ $tarifasConjunto->tipo == 'otros' ? 'selected' : ''  }} >otros</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="form" class="form-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="Activo" {{ $tarifasConjunto->estado == 'Activo' ? : '' }}>Activo</option>
                            <option value="No Activo" {{ $tarifasConjunto->estado == 'No Activo' ? : '' }}>No Activo</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Acualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection
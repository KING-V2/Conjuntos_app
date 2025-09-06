@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Edicion Reserva</h5>
        <div class="card-body">
            {{ $info_residente->usuario->name }}<br>
            {{ $info_residente->conjunto->nombre }}<br>
            {{ $info_residente->bloque->nombre }}<br>
            {{ $info_residente->apartamento->nombre }}<br>
            {{ $info_residente->estado }}<br>
            {{ $info_residente->tipo_residente }}<br>
            <hr>
        </div>
    </div>
</div>
@endsection
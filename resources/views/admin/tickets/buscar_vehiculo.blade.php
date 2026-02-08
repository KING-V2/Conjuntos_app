<p><b>Información del cliente</b></p>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="nombres"><i class="fas fa-user"></i> Nombre del cliente </label>
        <p>{{$vehiculo->cliente->nombres}}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="numero_documento"><i class="fas fa-id-card"></i> Numero de Documento </label>
        <p>{{$vehiculo->cliente->numero_documento}}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="email"><i class="fas fa-envelope"></i> Email </label>
        <p>{{$vehiculo->cliente->email}}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="celular"><i class="fas fa-mobile-alt"></i> Celular </label>
        <p>{{$vehiculo->cliente->celular}}</p>
        </div>
    </div>
</div>

<hr>

<p><b>Información del vehiculo</b></p>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="placa"><i class="fas fa-user"></i> Marca del vehiculo </label>
        <p>{{$vehiculo->placa}}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="marca"><i class="fas fa-id-card"></i> Marca del vehiculo </label>
        <p>{{$vehiculo->marca}}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <label for="tipo"><i class="fas fa-envelope"></i> Tipo de vehiculo </label>
        <p>{{$vehiculo->tipo}}</p>
        </div>
    </div>
</div>
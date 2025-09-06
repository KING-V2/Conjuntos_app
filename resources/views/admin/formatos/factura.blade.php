@extends('layouts.original')

@section('content')
    <div class="ticket">
        <h2>{{ $conjunto->nombre }}</h2>
        <p><strong>Dirección:</strong> {{ $conjunto->direccion }}</p>
        <hr>
        <p><strong>Placa del Vehículo:</strong> {{ $parqueadero->placa }}</p>
        <p><strong>Fecha y Hora de Ingreso:</strong> {{ $parqueadero->hora_ingreso }}</p>
        <p><strong>Fecha y Hora de Salida:</strong> {{ $parqueadero->hora_salida }}</p>
        <hr>
        <p><strong>Valor a Pagar:</strong> ${{ number_format($parqueadero->valor, 0, ',', '.') }}</p>
        <hr>
        <p>¡Gracias por su visita!</p>
    </div>

    <script>
        window.onload = function() {
            window.print(); // Imprimir automáticamente
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            width: 250px;
            margin: auto;
        }
        .ticket {
            border: 1px dashed black;
            padding: 10px;
            font-size: 14px;
        }
    </style>
@endsection

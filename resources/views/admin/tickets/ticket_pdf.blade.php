<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión de Ticket</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.2;
            width: 300px;
            max-width: 300px;
            overflow-x: hidden;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            background-color: #fff;
        }
        .container {
            border: 1px solid #000;
            padding: 10px;
        }
        .header, .footer {
            font-weight: bold;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 10px;
        }
        .print-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        @media print {
        .print-button {
        display: none; 
        }
    }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
            {{ $conjunto->nombre }}<br>
            {{ $conjunto->direccion }}<br>
            {{ $conjunto->nit }}<br>
            Nro de pago(ID): {{ $ticket->id }}<br>
            <strong>ORIGINAL</strong>
        </div>

        <div class="line"></div>

        
        <h3 style="margin: 5px 0; font-size: 14px;text-align:center">Numero de Ticket:{{$ticket->codigo_ticket}}</h3>

        <div class="line"></div>

        <div style="text-align: left;">
        <strong>Datos del Cliente:</strong><br>

        @if($ticket->apartamento)
            <b>Apartamento:</b> {{ $ticket->apartamento->nombre }} ({{ $ticket->apartamento->codigo }})<br>
        @endif

        @if($ticket->casa)
            <b>Casa:</b> {{ $ticket->casa->nombre }} ({{ $ticket->casa->codigo }})<br>
        @endif

        @if(!$ticket->apartamento && !$ticket->casa)
            <b>Inmueble:</b> No especificado<br>
        @endif

        <strong>Señor(a):</strong> {{ $ticket->cliente->nombres }}<br>
        <strong>Placa:</strong> {{ $ticket->vehiculo?->placa ?? 'Sin placa' }}<br>
        </div>

        <div class="line"></div>
        
        <div>
            <b>Espacio numero: </b> {{ $ticket->espacio->numero }} <br>
            <b>Fecha de ingreso: </b> {{ $ticket->fecha_ingreso }} <br>
            <b>Hora de ingreso: </b> {{ $ticket->hora_ingreso }} <br>
        </div>

        <div class="line"></div>

         
        <div class="footer" style="text-align:center">
            <small>
                <b>Hora de Impresión: </b> {{$fecha_hora}} <br>
                <b>Usuario: </b> {{ $ticket->cliente->nombres }} <br>
            </small>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión de Factura</title>
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
            Nro de pago(ID): {{ $factura->id }}<br>
            <strong>ORIGINAL</strong>
        </div>

        <div class="line"></div>

        
        <h3 style="margin: 5px 0; font-size: 14px;text-align:center">Numero de Factura:{{$factura->ticket->codigo_ticket}}</h3>

        <div class="line"></div>

        <div style="text-align: left;">
        <strong>Datos del Cliente:</strong><br>

        @if($factura->ticket->apartamento)
            <b>Apartamento:</b> {{ $factura->ticket->apartamento->nombre }} ({{ $factura->ticket->apartamento->codigo }})<br>
        @endif

        @if($factura->ticket->casa)
            <b>Casa:</b> {{ $factura->ticket->casa->nombre }} ({{ $factura->ticket->casa->codigo }})<br>
        @endif

        @if(!$factura->ticket->apartamento && !$factura->ticket->casa)
            <b>Inmueble:</b> No especificado<br>
        @endif

        <strong>Señor(a):</strong> {{ $factura->cliente->nombres }}<br>
        <strong>Placa:</strong> {{ $factura->ticket->vehiculo?->placa ?? 'Sin placa' }}<br>
        </div>

        <div class="line"></div>
        <div style="text-align: left;">
        <strong>Datos del Servicio:</strong><br>
        <div>
            <b>Espacio numero: </b> {{$factura->ticket->espacio->numero }} <br>
            <b>Fecha de ingreso: </b> {{ $factura->ticket->fecha_ingreso }} <br>
            <b>Hora de ingreso: </b> {{ $factura->ticket->hora_ingreso }} <br>
        </div>

        <div class="line"></div>

        <div>
            <table>
                <thead>
                    <th style="width: 150px">Detalle</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $factura->obs }}</td>
                        <td style="text-align: center">1</td>
                        <td>{{ $conjunto->divisa." ".$factura->monto_total }}</td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: right"><b>Monto Total: </b>{{ $conjunto->divisa." ".$factura->monto_total }}</p>
        </div>

         
        <div class="footer" style="text-align:center">
            <small>
                <b>Hora de Impresión: </b> {{$fecha_hora}} <br>
                <b>Usuario: </b> {{ $factura->cliente->nombres }} <br>
            </small>
        </div>
    </div>
</body>
</html>
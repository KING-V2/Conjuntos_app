<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta a tu PQR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .content {
            text-align: justify;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="{{ $logo }}" alt="Logo Conjunto Residencial" class="logo">
        <h2>Respuesta a tu PQR</h2>

        <div class="content">
            <p><strong>Contenido del PQR:</strong></p>
            <p>{{ $contenido_pqr }}</p>

            <p><strong>Respuesta del Administrador:</strong></p>
            <p>{{ $respuesta }}</p>

            <p><strong>Administrador:</strong> {{ $administrador }}</p>
            <p><strong>Fecha y Hora de Respuesta:</strong> {{ $fecha_respuesta }}</p>
        </div>

        <div class="footer">
            <p>Gracias por contactarnos. Si tienes más dudas, no dudes en escribirnos.</p>
            <p>&copy; {{ date('Y') }} Conjunto Residencial</p>
        </div>
    </div>

</body>
</html>

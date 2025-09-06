<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Trasteo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            max-width: 600px;
            text-align: center;
        }
        .logo {
            width: 100px;
        }
        .header {
            text-align: center;
        }
        .content {
            margin-top: 20px;
            text-align: left;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{$logo}}" alt="{{$nombre_conjunto}}" class="logo">
        <h2>{{$nombre_conjunto}}</h2>
        <h4>{{$direccion_conjunto}}</h4>
        <h3>Solicitud de Trasteo</h3>
    </div>
    <div class="content">
        <p>Estimado(a) <strong>{{$residente}}</strong>,</p>
        <p>{{$respuesta_admin}}</p>
        <ul>
            <li><strong>Fecha de Solicitud:</strong>{{$fecha}} {{$hora}}</li>
            <li><strong>Estado de Solicitud:</strong> {{$estado}}</li>
            <li><strong>Administrador:</strong> {{$administrador}}</li>
        </ul>
        <p>Le recordamos que el trasteo deberá realizarse en los horarios permitidos por la administración y siguiendo las normas establecidas para la movilización de enseres dentro del conjunto residencial.</p>
        <p>Para cualquier consulta adicional, no dude en comunicarse con la administración.</p>
    </div>
    <div class="footer">
        <p>Agradecemos su cooperación.</p>
        <p>Atentamente,</p>
        <p><strong>Administración {{$nombre_conjunto}}</strong></p>
    </div>
</body>
</html>

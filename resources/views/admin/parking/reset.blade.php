<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restablecer contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white w-96 p-8">
        <div class="flex justify-center mb-6">
            <i class="fa-solid fa-key text-blue-600 text-5xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Restablecer contraseña</h2>
        <p class="text-center text-gray-500 mb-6">Ingresa tu nueva contraseña</p>

        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 border border-green-400 text-green-700">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/reset') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                <i class="fa-solid fa-lock text-gray-400 mr-2"></i>
                <input type="password" name="password" placeholder="Nueva contraseña" class="w-full outline-none text-gray-700" required />
            </div>

            <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                <i class="fa-solid fa-lock text-gray-400 mr-2"></i>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="w-full outline-none text-gray-700" required />
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Restablecer
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline text-sm">
                <i class="fa-solid fa-arrow-left mr-1"></i> Volver al login
            </a>
        </div>
    </div>
</body>
</html>

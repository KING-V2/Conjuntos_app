<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Espacio - Parqueadero</title>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col sticky top-0 h-screen">
       <nav class="flex-1 flex flex-col justify-center p-4 space-y-3 text-gray-700">
    <a href="{{ route('dashboard') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-gauge mr-3"></i> Dashboard
    </a>

    <a href="{{ route('clients.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('clients.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-user-group mr-3"></i> Clientes
    </a>

    <a href="{{ route('vehicles.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('vehicles.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-car mr-3"></i> Vehículos
    </a>

    <a href="{{ route('spaces.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('spaces.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-square-parking mr-3"></i> Espacios
    </a>

    <a href="{{ route('reservations.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('reservations.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-clock mr-3"></i> Reservas
    </a>

    <a href="{{ route('invoices.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('invoices.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-file-invoice-dollar mr-3"></i> Facturación
    </a>

    <a href="{{ route('reports.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('reports.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-chart-line mr-3"></i> Reportes
    </a>

    <a href="{{ route('apartments.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('apartments.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-building mr-3"></i> Apartamentos
    </a>

    <a href="{{ route('settings.index') }}" 
       class="flex items-center p-2 rounded-lg {{ request()->routeIs('settings.index') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        <i class="fa-solid fa-gear mr-3"></i> Configuración
    </a>
</nav>

        <div class="p-4 border-t">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" id="logoutBtn" class="w-full flex items-center justify-center bg-red-500 text-white px-3 py-2 hover:bg-red-600">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenido -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-4 sticky top-0 z-10">
            <h1 class="text-2xl font-semibold text-gray-800">Registrar Espacio</h1>
            <div class="flex items-center space-x-6 relative">
                <!-- Notificaciones -->
                <div class="relative">
                    <button id="notifBtn" class="w-10 h-10 flex items-center justify-center bg-blue-600 rounded-full relative focus:outline-none">
                        <i class="fa-solid fa-bell text-white text-lg"></i>
                    </button>
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg border z-20">
                        <div class="p-4 border-b"><h3 class="text-gray-700 font-semibold">Notificaciones</h3></div>
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="px-4 py-3 hover:bg-gray-100 flex items-start space-x-3">
                                <i class="fa-solid fa-car text-blue-500 mt-1"></i><span>Nuevo espacio registrado.</span>
                            </li>
                        </ul>
                        <div class="p-2 border-t text-center"><a href="#" class="text-blue-600 text-sm hover:underline">Ver todas</a></div>
                    </div>
                </div>
                <!-- Perfil -->
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                         alt="Perfil" class="w-10 h-10 rounded-full border">
                    <div class="flex flex-col">
                        <span class="text-gray-700">{{ Auth::user()->email }}</span>
                        <span class="text-sm text-gray-500">Administrador</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Formulario -->
        <main class="flex-1 p-6">
            <div class="bg-white shadow p-6 w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    <i class="fa-solid fa-plus mr-2 text-blue-600"></i> Nuevo Espacio
                </h2>
                <form action="{{ route('spaces.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Número -->
                    <div>
                        <label for="numero" class="block text-gray-700 font-medium">Número</label>
                        <input type="text" id="numero" name="numero" value="{{ old('numero') }}" required class="w-full border px-3 py-2">
                        @error('numero') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Ubicación -->
                    <div>
                        <label for="ubicacion" class="block text-gray-700 font-medium">Ubicación</label>
                        <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion') }}" class="w-full border px-3 py-2">
                        @error('ubicacion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="block text-gray-700 font-medium">Tipo</label>
                        <select id="tipo" name="tipo" class="w-full border px-3 py-2">
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="bicicleta">Bicicleta</option>
                        </select>
                        @error('tipo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="block text-gray-700 font-medium">Estado</label>
                        <select id="estado" name="estado" class="w-full border px-3 py-2">
                            <option value="disponible">Disponible</option>
                            <option value="ocupado">Ocupado</option>
                            <option value="reservado">Reservado</option>
                        </select>
                        @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="md:col-span-2 flex justify-end space-x-3">
                        <a href="{{ route('spaces.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<!-- Scripts -->
<script>
    // Confirmación logout
    document.getElementById('logoutBtn').addEventListener('click', function () {
        if (confirm('¿Seguro que deseas cerrar sesión?')) {
            document.getElementById('logoutForm').submit();
        }
    });

    // Dropdown notificaciones
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    notifBtn.addEventListener('click', () => notifDropdown.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

    // Mensaje de éxito
    @if(session('success'))
        const alertBox = document.createElement("div");
        alertBox.className = "fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg transition-opacity duration-500";
        alertBox.innerText = "{{ session('success') }}";
        document.body.appendChild(alertBox);

        setTimeout(() => {
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
        }, 3000);
    @endif
</script>

</body>
</html>

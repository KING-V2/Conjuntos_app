<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Parqueadero</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1 class="text-2xl font-semibold text-gray-800">Reportes</h1>
            <div class="flex items-center space-x-6 relative">
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
                    <i class="fa-solid fa-filter mr-2 text-blue-600"></i> Filtrar Reportes
                </h2>

                <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium">Desde</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                               class="w-full border px-3 py-2 focus:ring focus:ring-blue-200">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Hasta</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                               class="w-full border px-3 py-2 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 w-full">
                            Filtrar
                        </button>
                    </div>
                </form>

                <!-- Tabla de resultados -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border">
                        <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-2 px-4 border">Cod</th>
                            <th class="py-2 px-4 border">Factura</th>
                            <th class="py-2 px-4 border">Cliente</th>
                            <th class="py-2 px-4 border">Vehículo</th>
                            <th class="py-2 px-4 border">Monto</th>
                            <th class="py-2 px-4 border">Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reports as $report)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border text-center">{{ $report->id }}</td>
                                <td class="py-2 px-4 border">{{ $report->invoice_number }}</td>
                                <td class="py-2 px-4 border">{{ $report->client->nombre }}</td>
                                <td class="py-2 px-4 border">{{ $report->vehicle->placa }}</td>
                                <td class="py-2 px-4 border">${{ number_format($report->amount, 2) }}</td>
                                <td class="py-2 px-4 border">{{ $report->invoice_date->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center">No hay reportes disponibles.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function () {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "Tu sesión actual se cerrará.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>

</body>
</html>

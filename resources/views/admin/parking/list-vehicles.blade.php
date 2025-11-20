@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Lista Vehiculos</h5>
        <div class="card-body">
            <table class="table table-bordered" style="overflow-x: auto;">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-6 py-3 border-b">Cod</th>
                        <th class="px-6 py-3 border-b">Placa</th>
                        <th class="px-6 py-3 border-b">Marca</th>
                        <th class="px-6 py-3 border-b">Modelo</th>
                        <th class="px-6 py-3 border-b">Propietario</th>
                        <th class="px-6 py-3 border-b">Descripción</th>
                        <th class="px-6 py-3 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 border-b">{{ $vehicle->placa }}</td>
                            <td class="px-6 py-4 border-b">{{ $vehicle->marca }}</td>
                            <td class="px-6 py-4 border-b">{{ $vehicle->modelo }}</td>
                            <td class="px-6 py-4 border-b">{{ $vehicle->propietario }}</td>
                            <td class="px-6 py-4 border-b">{{ $vehicle->descripcion }}</td>
                            <td class="px-6 py-4 border-b flex space-x-2">
                                <a href="#" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                    Editar
                                </a>
                                <form  method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No hay vehículos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<!-- Scripts -->
<script>
    // Confirmación de logout
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

    // Dropdown notificaciones
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    notifBtn.addEventListener('click', () => notifDropdown.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

    // Confirmación eliminación
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
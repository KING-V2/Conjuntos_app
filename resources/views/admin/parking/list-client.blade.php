@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Lista Clientes</h5>
        <div class="card-body">
            <table class="table table-bordered" style="overflow-x: auto;">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-6 py-3 border-b">#</th>
                        <th class="px-6 py-3 border-b">Nombre</th>
                        <th class="px-6 py-3 border-b">Cédula</th>
                        <th class="px-6 py-3 border-b">Teléfono</th>
                        <th class="px-6 py-3 border-b">Email</th>
                        <th class="px-6 py-3 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 border-b">{{ $client->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $client->cedula }}</td>
                            <td class="px-6 py-4 border-b">{{ $client->telefono }}</td>
                            <td class="px-6 py-4 border-b">{{ $client->email }}</td>
                            <td class="px-6 py-4 border-b flex space-x-2">
                                <button onclick="openEditModal({{ $client }})" class="btn btn-info">
                                    Editar
                                </button>

                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2" onclick="return confirmDelete(event)">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No hay clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>  
</div>

<!-- Modal Editar -->
<div id="editModal" class="modal fade">
    <div class="bg-white rounded-lg w-96 p-6 relative">
        <h3 class="text-lg font-semibold mb-4">Editar Cliente</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" id="editNombre" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Cédula</label>
                <input type="text" name="cedula" id="editCedula" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="text" name="telefono" id="editTelefono" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="editEmail" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascripts')
<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
        return false;
    }

    function openEditModal(client) {
        document.getElementById('editNombre').value = client.nombre;
        document.getElementById('editCedula').value = client.cedula;
        document.getElementById('editTelefono').value = client.telefono;
        document.getElementById('editEmail').value = client.email;
        document.getElementById('editForm').action = `/clients/${client.id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
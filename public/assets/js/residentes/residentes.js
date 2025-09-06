$(document).ready(function() {
    // Inicializar el DataTable con filtros personalizados
    var table = $('#dt-search-residente').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/searchResidenteJson',
            data: function (d) {
                // Pasar los valores de los filtros al backend
                d.filter_usuario_id = $('#filter_usuario_id').val();
                d.filter_casa_id = $('#filter_casa_id').val();
                d.filter_estado = $('#filter_estado').val();
                d.filter_tipo_residente = $('#filter_tipo_residente').val();
            }
        },
        columns: [
            { data: 'casas', name: 'casa_id' },
            { data: 'usuario', name: 'usuario' },
            { data: 'estado', name: 'estado' },
            { data: 'tipo_residente', name: 'tipo_residente' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // Evento para aplicar filtros
    $('#filter').on('click', function() {
        table.draw();  // Volver a cargar la tabla con los nuevos filtros
    });

    // Evento para resetear filtros
    $('#reset').on('click', function() {
        $('#filter_casa_id').val('');  // Limpiar el campo de nombre
        $('#filter_usuario_id').val('');  // Limpiar el campo de nombre
        $('#filter_estado').val('');  // Limpiar el campo de nombre
        $('#filter_tipo_residente').val('');  // Limpiar el campo de nombre
        table.draw();  // Volver a cargar la tabla sin filtros
    });
});

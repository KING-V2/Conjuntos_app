@extends('layouts.admin')
@section('aditional_styles')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <style>
        /* --- Estilo moderno para los botones de paginación DataTables --- */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #f5f7fa !important;
            border: 1px solid #d1d5db !important;
            color: #374151 !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            margin: 0 3px !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #3b82f6 !important;
            color: white !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 2px 5px rgba(59, 130, 246, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #3b82f6 !important;
            color: #fff !important;
            border-color: #2563eb !important;
        }

        /* Mueve la caja de búsqueda a la izquierda */
        .dataTables_filter {
            float: left !important;
            text-align: left !important;
        }

        /* Opcional: ajusta márgenes para que se vea centrado con el resto */
        .dataTables_filter label {
            font-weight: 600;
            color: #374151;
        }
        .dataTables_filter input {
            margin-left: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 4px 8px;
        }
    </style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">Listado Correspondencia</h5>
        <hr>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-danger" onclick="recepcionServiciosConjuntos('Luz');">Servicios de Luz</button>
                    </div>
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-info" onclick="recepcionServiciosConjuntos('Agua');">Servicios de Agua</button>
                    </div>
                    <div class="col-md-3">
                        <button class="ml-3 btn btn-success" onclick="recepcionServiciosConjuntos('Gas');">Servicios de Gas</button>
                    </div>
                </div>
                <br>
                <div class="card-datatable table-responsive pt-0">
                    <table id="tablaCorrespondencia" class="table table-bordered"  style="overflow-x: auto; font-size: 18px;">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> casa </th>
                                <th> luz </th>
                                <th> agua </th>
                                <th> gas </th>
                                <th> mensajes </th>
                                <th> paquetes </th>
                                <th> domiciliario </th>
                                <th> Reiniciar </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 
    <script src="{{ asset('assets/js/correspondencia/correspondencia.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tablaCorrespondencia').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("correspondencia.listar") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'casa', name: 'casa.nombre' },
                    { data: 'luz', name: 'luz', orderable: false, searchable: true },
                    { data: 'agua', name: 'agua', orderable: false, searchable: true },
                    { data: 'gas', name: 'gas', orderable: false, searchable: true },
                    { data: 'mensajes', name: 'mensajes', orderable: false, searchable: true },
                    { data: 'paquetes', name: 'paquetes', orderable: false, searchable: true },
                    { data: 'domiciliario', name: 'domiciliario', orderable: false, searchable: true },
                    { data: 'reiniciar', orderable: false, searchable: false }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
                    search: "Buscar:" // 👈 Cambia el texto aquí
                },
                pageLength: 25,
                responsive: true,
                autoWidth: false,
                deferRender: true,
                dom: '<"top"f>rt<"bottom"lp><"clear">',
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm justify-content-center');
                }
            });
        });
        
    </script>
@endsection
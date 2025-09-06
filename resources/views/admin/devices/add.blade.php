@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <!-- Devices -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic-devices table table-bordered" style="overflow-x: auto;">
                <thead>
                    <tr>
                        <th> Device Id </th>
                        <th> date </th>
                        <th> name </th>
                        <th> address </th>
                        <th> email </th>
                        <th> phone </th>
                        <th> coordinates </th>
                        <th> user </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Devices -->
</div>
@endsection
@section('javascripts')

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/js/audios/configs.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>

    <script src="{{ asset('assets/js/audios/audios.js') }}"></script>
@endsection
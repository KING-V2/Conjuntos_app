@extends('layouts.app')

@section('content')
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="{{ url('login')}}" class="app-brand-link gap-2">
            <img src="{{ asset('storage/logos')}}/{{ $logo ? $logo : 'logo_empresa.png' }}" alt="Logo Empresa" width="100%">
            </a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-12">
              <label for="inputEmailAddress" class="form-label">Email</label>
              <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="jhon@example.com">
            </div>
            <div class="col-12">
              <label for="inputChoosePassword" class="form-label">Password</label>
              <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" name="password" placeholder="Enter Password">
                <a href="javascript:;" class="input-group-text bg-transparent"><i
                    class="bi bi-eye-slash-fill"></i></a>
              </div>
            </div>
            <div class="line"></div>
            <div class="col-12 mt-5">
              <div class="d-grid">
                <button type="submit" class="btn btn-grd-primary">Login</button>
              </div>
            </div>
            
            @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
@endsection

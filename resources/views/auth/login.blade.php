@extends('layouts.app')
@section('title')Login @endsection

@section('content')

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">   
                
              @if (Route::has('login'))
              @auth
                <div class="text-center">
                  @if (Auth::user()->type == 'YYS')
                    <h5 class="text-center">Status</h5>
                    <h4> {{ Auth::user()->name }} [YYS]</h4>
                    <a href="{{ route('YYS.home'); }}" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Home</a>                 
                  @else
                  <h5 class="text-center">Status</h5>
                  <h4> {{ Auth::user()->name }} [{{Auth::user()->type}}]</h4>
                    <a href="{{ route('USER.home'); }}" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Home</a>                                   
                  @endif
                </div>
              @else
                <h1 class="text-center">Log In</h1>

                <form method="POST" action="{{ route('login') }}">
                        @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                    
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ Session::get('error') }} </strong>
                        </div>
                    @endif

                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  <div class="text-center">
                    <p class="fs-2 mb-0 fw-bold">Lupa password? <br> Silahkan hubungi admin.</p>
                  </div>
                </form>

                @endauth
              @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

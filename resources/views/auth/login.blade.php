@extends('layouts.app')
@section('title')Login @endsection

@section('content')

  <div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-7 col-xxl-8">
            <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
              <img src="{{ asset('assets/images/login-security.svg') }}" alt="" class="img-fluid" width="500">
            </div>
          </div>
          <div class="col-xl-5 col-xxl-4">
            <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
              <div class="auth-max-width col-sm-10 col-md-10 col-xl-10 px-4">
                 <a href="/" class="text-nowrap logo-img d-block px-4 pt-4 w-100 text-center">             
                  <img src="{{ asset('assets/logo.jpg') }}" class="light-logo" alt="Logo-light" />
                </a>
                <h2 class="mb-1 fs-7 fw-bolder  text-center">Selamat Datang!</h2>                                      
                  @if (Route::has('login'))
              @auth
               <p class="mb-7  text-center">Awali Harimu Dengan Senyuman.</p>      
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
              <p class="mb-7  text-center">Silahkan Login.</p>      

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

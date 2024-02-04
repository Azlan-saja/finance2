@extends('yys.sidebar')
@section('title')Ubah Akun - YYS @endsection

@section('cssSidebar')
@endsection


@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Ubah Akun
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif    

                 <form action="{{ route('pengguna-aktif.ubah-akun') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2">Nama</label>                         
                              <div class="col-lg-10">
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" value="{{ Auth::User()->name }}" required>
                                  @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                                                                                                                         
                    <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2">Email</label>                         
                              <div class="col-lg-10">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ Auth::User()->email }}" required>
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                                                                                                                         
                    <div class="form-actions col-lg-10 ms-auto">
                        <button type="submit" class="btn btn-secondary me-6">Simpan Perubahan </button>
                        <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                    </div>
                </form>

            <!-- ISI END -->
        </div>
    </div>        
</div>        
@endsection



@section('jsSidebar')

@endsection

@extends('yys.sidebar')
@section('title')Tambah Pengguna - YYS @endsection

@section('cssSidebar')

@endsection


@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Tambah Pengguna
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('pengguna.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>
                 <form action="{{ route('pengguna.store') }}" method="POST">
                    @csrf
                    <div class="form-body">                                                                                                                                                            
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label pt-2">Nama</label>                         
                              <div class="col-lg-11">
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label pt-2">Email</label>                         
                              <div class="col-lg-11">
                                <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                  
                     <div class="mb-3">
                        <div class="row pb-2">
                          <label class="col-lg-1 form-label pt-2">Unit</label>                         
                              <div class="col-lg-11">                              
                                <select class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required>
                                        <option disabled selected value="" class="bg-dark text-white fw-bold fs-5">Pilih </option>
                                        <option value="0">RA</option>
                                        <option value="1">SD</option>
                                        <option value="2">SMP</option>
                                        <option value="3">YYS</option>
                                </select>                                
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                        </div>
                      </div>                                                                                                        
                    <div class="form-actions col-lg-11 ms-auto">
                        <button type="submit" class="btn btn-primary me-6"> Simpan </button>
                        <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                    </div>
                </form>

            <!-- ISI END -->
        </div>
    </div>        
</div>        
@endsection






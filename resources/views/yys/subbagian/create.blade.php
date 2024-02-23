@extends('yys.sidebar')
@section('title')Tambah Bagian - YYS @endsection

@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Bagian
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Tambah Sub Bagian
              </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('subbagian.index', $id) }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                <div class="d-flex align-items-center gap-4 p-1 mb-3 rounded bg-info-subtle shadow-none">
                    <div class="position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-check" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /><path d="M15 19l2 2l4 -4" /></svg>
                    </div>
                    <div class="pe-5">
                      <h5 class="fw-semibold">
                          {{ $bagian->type }}
                      </h5>
                      <span class="fw-bold">Unit</span>
                    </div>
                    <div>
                       <h5 class="fw-semibold">
                        {{ $bagian->bagian }}
                      </h5>
                      <span class="fw-bold">Bagian</span>
                    </div>
                  </div>


                 <form action="{{ route('subbagian.store', $id) }}" method="POST">
                    @csrf
                    <div class="form-body">                      
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label pt-2">Sub Bagian</label>                         
                              <div class="col-md-11">
                                <input type="text" class="form-control  @error('subbagian') is-invalid @enderror" name="subbagian" value="{{ old('subbagian') }}" required>
                                  @error('subbagian')
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

 
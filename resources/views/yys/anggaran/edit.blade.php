@extends('yys.sidebar')
@section('title')Edit Sumber Anggaran - YYS @endsection

@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Edit Sumber Anggaran
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('anggaran.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 <form action="{{ route('anggaran.update',$anggaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">                     
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label pt-2">Sumber Anggaran</label>                         
                              <div class="col-md-11">
                                <input type="text" class="form-control  @error('anggaran') is-invalid @enderror" name="anggaran" value="{{ $anggaran->anggaran }}" required>
                                  @error('anggaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                    <div class="form-actions col-md-11 ms-auto">
                        <button type="submit" class="btn btn-secondary  me-6"> Simpan Perubahan </button>
                        <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                    </div>
                </form>

            <!-- ISI END -->
        </div>
    </div>        
</div>        
@endsection


@extends('yys.sidebar')
@section('title')Edit Bagian - YYS @endsection

@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Edit Bagian
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('bagian.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 <form action="{{ route('bagian.update',$bagian->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                      <div class="mb-3">
                        <div class="row">
                          <label class="col-lg-1 form-label pt-2">Unit</label>                         
                              <div class="col-md-11">                              
                                <select class="form-control @error('type') is-invalid @enderror" name="type" required>
                                        <option value="" selected>Pilih [{{ $bagian->type }}]</option>
                                        <option disabled>--------</option>                    
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
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label pt-2">Bagian</label>                         
                              <div class="col-md-11">
                                <input type="text" class="form-control  @error('bagian') is-invalid @enderror" name="bagian" value="{{ $bagian->bagian }}" required>
                                  @error('bagian')
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


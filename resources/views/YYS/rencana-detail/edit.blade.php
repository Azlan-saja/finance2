@extends('yys.sidebar')
@section('title')Edit Sub Bagian - YYS @endsection

@section('pages')
<div class="container mt-4">
   <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Bagian
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Edit Sub Bagian
              </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('subbagian.index', $subBagian->bagian_id) }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 <form action="{{ route('subbagian.update', ['id' => $subBagian->bagian_id, 'subbagian' => $subBagian->id ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                      <div class="mb-3">
                       <div class="row">
                                <label class="col-lg-1 form-label pt-2">Sub Bagian</label>                         
                              <div class="col-md-11">
                                <input type="text" class="form-control  @error('subbagian') is-invalid @enderror" name="subbagian" value="{{ $subBagian->subbagian }}" required>
                                  @error('subbagian')
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


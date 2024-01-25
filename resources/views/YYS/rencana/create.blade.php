@extends('yys.sidebar')
@section('title')Tambah Rencana Anggaran Belanja - RAB - YYS @endsection

@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Tambah Rencana Anggaran Belanja - RAB
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('rencana.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 @if ($message = Session::get('error'))
                         <div class="alert alert-error alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif

                 <form action="{{ route('rencana.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                       <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label">Besar Anggaran</label>                         
                              <div class="col-lg-11">
                                <input id="anggaran" type="text" class="form-control  @error('anggaran') is-invalid @enderror" name="anggaran" value="{{ old('anggaran') }}" required>
                                  @error('anggaran')
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
                                <select class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" required>
                                        <option disabled selected value="" class="bg-dark text-white fw-bold fs-5">Pilih </option>
                                        <!-- <option class="bg-danger border m-3 p-3" disabled>&nbsp;</option>   -->
                                        <option value="0">RA</option>
                                        <option value="1">SD</option>
                                        <option value="2">SMP</option>
                                        <option value="3">YYS</option>
                                </select>                                
                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                        </div>
                      </div>
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-1 form-label">Tahun Anggaran</label>                         
                              <div class="col-lg-11">
                                <input type="text" class="form-control  @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun') }}" required placeholder="1999/2000">
                                  @error('tahun')
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

@section('jsSidebar')
<script>
  function ribuan(string) {
    var myinput = document.getElementById(string);
    myinput.addEventListener('keyup', function() {
      var val = this.value;
      val = accounting.formatNumber(val);              
      this.value = val;
    });
  }
  ribuan("anggaran");
</script>
<script src="{{ asset('assets/js/accounting.js') }}"></script>
@endsection


@extends('yys.sidebar')
@section('title')Edit Beban - YYS @endsection

@section('cssSidebar')
@endsection


@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Edit Beban
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('beban.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 <form action="{{ route('beban.update', $beban->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">     
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Nama Beban</label>                         
                              <div class="col-md-10">
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" value="{{$beban->nama }}" required>
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
                                <label class="col-lg-2 form-label pt-2 text-end">Besaran Nilai</label>                         
                              <div class="col-md-10">
                                <input id="besaran" type="text" id="besaran" class="form-control  @error('besaran') is-invalid @enderror" name="besaran" value="{{ number_format($beban->besaran,0,',','.') }}" required>
                                  @error('besaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Tahun Masuk</label>                         
                              <div class="col-md-10">
                                <input maxlength="4" type="text" class="form-control  @error('masuk') is-invalid @enderror" name="masuk" value="{{ $beban->masuk }}" placeholder="1999/2000" required>
                                  @error('masuk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Tahun Akhir</label>                         
                              <div class="col-md-10">
                                <input maxlength="4" type="text" class="form-control  @error('akhir') is-invalid @enderror" name="akhir" value="{{ $beban->akhir }}" placeholder="1999/2000" required>
                                  @error('akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                    <div class="form-actions col-lg-10 ms-auto">
                        <button type="submit" class="btn btn-secondary me-6"> Simpan Perubahan </button>
                        <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                    </div>
                </form>

            <!-- ISI END -->
        </div>
    </div>        
</div>        
@endsection



@section('jsSidebar')
<script src="{{ asset('assets/js/accounting.js') }}"></script>

<script>
      function ribuan(string) {
    var myinput = document.getElementById(string);
    myinput.addEventListener('keyup', function() {
      var val = this.value;
      val = accounting.formatNumber(val);              
      this.value = val;
    });
  }
  ribuan("besaran");

</script>
@endsection

@extends('yys.sidebar')
@section('title')Edit Pemasukan - YYS @endsection

@section('cssSidebar')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}">
@endsection


@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Edit Pemasukan
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('pemasukan.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

                 <form action="{{ route('pemasukan.update',$pemasukan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">     
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Unit</label>                         
                              <div class="col-md-10">
                                 <select class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ $pemasukan->unit }}" required>
                                        <option disabled selected value="" class="bg-dark text-white fw-bold fs-5">Pilih [{{ $pemasukan->unit }}]</option>
                                        <option value="0">RA</option>
                                        <option value="1">SD</option>
                                        <option value="2">SMP</option>
                                        <option value="3">YYS</option>
                                </select>    
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
                                <label class="col-lg-2 form-label pt-2 text-end">Nama Pemasukan</label>                         
                              <div class="col-md-10">
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" value="{{$pemasukan->nama }}" required>
                                  @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                      <div class="mb-0">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-0 text-end">Sumber Masukan/Anggaran</label>                         
                              <div class="col-md-10">
                                 <select name="sumber" class="form-select form-control  @error('sumber') is-invalid @enderror" id="pilih_sumber" data-placeholder="Pilih [{{ $pemasukan->sumber }}]" required>
                                          <option></option>
                                          @foreach ($sumberanggaran as $data)
                                            <option value="{{ $data->anggaran }}"> {{ $data->anggaran }}</option>
                                          @endforeach
                                    </select>
                                  @error('sumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Nominal</label>                         
                              <div class="col-md-10">
                                <input type="text" id="nominal" class="form-control  @error('nominal') is-invalid @enderror" name="nominal" value="{{ $pemasukan->nominal }}" required>
                                  @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Tanggal</label>                         
                              <div class="col-md-10">
                                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $pemasukan->tanggal }}" required>
                                  @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                        
                      <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2 text-end">Tahun Ajaran</label>                         
                              <div class="col-md-10">
                                <input maxlength="9" type="text" class="form-control  @error('tahun') is-invalid @enderror" name="tahun" value="{{ $pemasukan->tahun }}" placeholder="1999/2000" required>
                                  @error('tahun')
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
<script src="{{ asset('assets/js/jquery.slim.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
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
  ribuan("nominal");


  $( '#pilih_sumber' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    selectionCssClass: 'select2--small',
    dropdownCssClass: 'select2--small',
} );
</script>
@endsection

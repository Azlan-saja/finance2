@extends('user.sidebar')
@section('title')Input Realisasi Anggaran - RAB - {{ Auth::user()->type }} @endsection

@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Input Realisasi Anggaran - RAB
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                <a href="{{ route('user.realisasi.index', $rencana_id) }}" class="btn btn-dark m-1">Kembali</a>
                <hr>
                <form action="{{ route('user.realisasi.store', ['rencana_id' => $rencana_id, 'kegiatan_id' => $kegiatan_id, 'bulan' => $bulan]) }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Unit</label>                         
                                <label class="col-lg-10 form-label">: {{ $rencana->unit }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Tahun</label>                         
                                <label class="col-lg-10 form-label">: {{ $rencana->tahun }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Bagian</label>                         
                                <label class="col-lg-10 form-label">: {{ $rencanadetail->nama_bagian }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Sub Bagian</label>                         
                                <label class="col-lg-10 form-label">: {{ $rencanasubbagian->nama_subbagian }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Uraian Kegiatan</label>                         
                                <label class="col-lg-10 form-label">: {{ $kegiatan->nama_kegiatan }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label">Bulan Ke-</label>                         
                                <label class="col-lg-10 form-label">: {{ $bulan }}</label>                                                                                 
                            </div>                     
                        </div>                     
                        <div class="mb-3">                            
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2">Nominal</label>                         
                                <div class="col-lg-10">
                                    <input type="hidden" name="rencana_id" value="{{ $rencana->id }}">
                                    <input type="hidden" name="rencana_detail_id" value="{{ $rencanadetail->id }}">
                                    <input type="hidden" name="rencana_detail_subbagian_id" value="{{ $rencanasubbagian->id }}">
                                    <input type="hidden" name="rencana_detail_kegiatan_id" value="{{ $kegiatan->id }}">
                                    <input type="hidden" name="bagian_id" value="{{ $rencanadetail->bagian_id }}">
                                    <input type="hidden" name="subbagian_id" value="{{ $rencanasubbagian->subbagian_id }}">
                                    <input id="nominal" type="text" class="form-control  @error('nominal') is-invalid @enderror" name="nominal" value="{{ number_format($nominal,0,',','.') }}" required>
                                    @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                          
                            </div>
                        </div>                                                                                                        
                        <div class="form-actions col-lg-10 ms-auto">
                            <button type="submit" class="btn btn-primary me-6"> Simpan </button>
                            <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                        </div>
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
ribuan("nominal");
</Script>
@endsection

@extends('user.sidebar')
@section('title')Rencana Anggaran Belanja - RAB - Uraian Kegiatan - {{ Auth::user()->type }} @endsection


@section('cssSidebar')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Rencana Anggaran Belanja - RAB
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Uraian Kegiatan
              </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->


            <div class="row">        
              <div class="col-lg-3">
                 <div class="text-center">
                    <a href="{{ route('user.rencana-detail.index', $rencana_id) }}" class="btn btn-dark mb-2">Kembali</a>                            
                    <a href="" class="btn btn-outline-primary mb-2 ms-3">Segarkan</a>  
                 </div> 
                 <div class="card bg-info-subtle">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" 
                      class="icon icon-tabler icon-tabler-lock-check card-img-top img-responsive" 
                      width="120" height="120" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /><path d="M15 19l2 2l4 -4" />
                  </svg><hr> -->
                  <div class="card-body p-0 m-3 ">   
                                                                     
                    <span class="fw-bold">Unit</span>
                    <h5 class="fw-semibold">
                      {{ $rencana->unit }}
                    </h5>                         
                    <hr>

                    <span class="fw-bold">Tahun Anggaran</span>
                    <h5 class="fw-semibold">
                      {{ $rencana->tahun }}
                    </h5>                         
                    <hr>

                    <span class="fw-bold">Bagian</span>
                    <h5 class="fw-semibold">
                       {{ $subbagian->bagians->bagian }}
                    </h5>                         
                    <hr>

                    <span class="fw-bold">Sub Bagian</span>
                    <h5 class="fw-semibold">
                       {{ $subbagian->subbagian }}
                    </h5>                         
                    <hr>
                    <span class="fw-bold">Total Rencana</span>
                    <h5 class="fw-semibold">
                       {{ 'Rp. '.number_format($grantotal,0,",",".") }}
                    </h5>                         
                    <hr>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="card">
                  <div class="card-body">

                          @if ($message = Session::get('success'))
                              <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                  <strong> {{ $message }} </strong>
                              </div>                           
                          @endif
                          @if ($message = Session::get('error'))
                              <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                  <strong> {{ $message }} </strong>
                              </div>                           
                          @endif
                        <form action="{{route('user.rencana-detail.store', ['rencana_id' => $rencana_id,'subbagian' => $subbagian])}}" method="POST">
                          @csrf
                          <input type="hidden" name="bagian_id" value="{{ $subbagian->bagians->id}}">
                          <input type="hidden" name="nama_bagian" value="{{ $subbagian->bagians->bagian}}">
                          <input type="hidden" name="subbagian_id" value="{{ $subbagian->id}}">
                          <input type="hidden" name="nama_subbagian" value="{{ $subbagian->subbagian}}">
                         
                          
                          <div class="form-body">                      
                            <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label">Uraian Kegiatan</label>                         
                                    <div class="col-lg-10">
                                    <select name="nama_kegiatan" class="form-select form-control  @error('nama_kegiatan') is-invalid @enderror" id="pilih_kegiatan" data-placeholder="Pilih" required>
                                          <option></option>
                                          @foreach ($kegiatan as $kegiatans)
                                            <option value="{{ $kegiatans->kegiatan }}"> {{ $kegiatans->kegiatan }}</option>
                                          @endforeach
                                    </select>

                                        @error('nama_kegiatan')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                        
                            <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label mt-2">Sasaran</label>                         
                                    <div class="col-lg-10">
                                      <select name="sasaran" id="pilih_sasaran" class="form-select form-control  @error('kegiatan') is-invalid @enderror" data-placeholder="Pilih" required>
                                          <option></option>
                                          @foreach ($sasaran as $sasarans)
                                            <option value="{{ $sasarans->sasaran }}"> {{ $sasarans->sasaran }}</option>
                                          @endforeach
                                      </select>
                                       @error('sasaran')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                        
                            <div class="mb-0">
                                  <div class="row">
                                    <label class="col-lg-2 form-label ">Sumber Anggaran</label>                         
                                    <div class="col-lg-10">
                                      <select name="anggaran" class="form-select form-control  @error('kegiatan') is-invalid @enderror" id="pilih_sumber" data-placeholder="Pilih" required>
                                            <option></option>
                                            @foreach ($anggaran as $anggarans)
                                              <option value="{{ $anggarans->anggaran }}"> {{ $anggarans->anggaran }}</option>
                                            @endforeach
                                      </select>
                                        @error('anggaran')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                        
                            <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label mt-1">Satuan</label>                         
                                    <div class="col-lg-10">
                                      <select name="satuan" class="form-select form-control  @error('kegiatan') is-invalid @enderror" id="pilih_satuan" data-placeholder="Pilih" required>
                                          <option></option>
                                          @foreach ($satuan as $satuans)
                                            <option value="{{ $satuans->satuan }}"> {{ $satuans->satuan }}</option>
                                          @endforeach
                                    </select>
                                        @error('satuan')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                        
                            <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label">Jumlah Sasaran</label>                         
                                    <div class="col-lg-10">
                                      <input value="{{ old('jumlah_sasaran') }}" type="number" class="form-control  @error('jumlah_sasaran') is-invalid @enderror" name="jumlah_sasaran"  required>
                                        @error('jumlah_sasaran')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                                                                                                                                                         
                            <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label mt-2">Harga Satuan</label>                         
                                    <div class="col-lg-10">
                                      <input value="{{ old('harga') }}" id="harga" type="text" class="form-control  @error('harga') is-invalid @enderror" name="harga"  required>
                                        @error('harga')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                        
                              <div class="mb-3">
                                  <div class="row">
                                    <label class="col-lg-2 form-label mt-2">Volume</label>                         
                                    <div class="col-lg-10">
                                      <input value="{{ old('volume') }}" type="number" class="form-control  @error('volume') is-invalid @enderror" name="volume"  required>
                                        @error('volume')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>                          
                                  </div>
                          </div>                                                                                                    
                          <div class="form-actions col-lg-10 ms-auto">
                              <button type="submit" class="btn btn-primary me-6"> Simpan </button>            
                          </div>
                      </form>
                  
                  </div>
                </div>
              </div>
            </div>


             <div class="row">        
              <div class="col-lg-12 col-md-12 p-0 m-0">
                   <div class="table-responsive rounded-2 mb-4">
                   <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">
                      <thead class="text-dark fs-4">
                        <tr class="bg-dark">
                          <th class="border-bottom-0 align-middle">
                            <span class="fw-semibold mb-0 text-white">#</span>
                          </th>                       
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'nama_kegiatan', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Uraian <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kegiatan
                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'sasaran', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Sasaran
                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'anggaran', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Sumber <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Anggaran
                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'satuan', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Satuan
                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'jumlah_sasaran', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Jumlah<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sasaran

                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'harga', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Harga<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Satuan
                              </a>
                          </th>
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'volume', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Volume
                              </a>
                          </th>
                         
                          <th class="border-bottom-0 align-middle">                          
                              <a class="fw-semibold mb-0 text-white" href="{{ route('rencana-detail.create',  ['rencana_id' => $rencana_id,'subbagian' => $subbagian->id,'sort' => 'total', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                                Jumlah<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Harga
                              </a>
                          </th>
                          <th class="border-bottom-0">                         
                          </th>                       
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($rencanadetailkegiatan as $data)
                        <tr>
                          <td class="border-bottom-0">
                              <h6 class="fw-normal mb-0"> {{ ++$i }}</h6>
                          </td>        
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal text-wrap">{{ $data->nama_kegiatan }}</p>
                          </td>                                    
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->sasaran }}</p>
                          </td>                                    
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->anggaran }}</p>
                          </td>                                    
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->satuan }}</p>
                          </td>                                    
                          <td class="border-bottom-0 text-center">
                            <p class="mb-0 fw-normal">{{ $data->jumlah_sasaran }}</p>
                          </td>                                    
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">Rp.{{ $data->harga }}</p>
                          </td>                                    
                          <td class="border-bottom-0 text-center">
                            <p class="mb-0 fw-normal">{{ $data->volume }}</p>
                          </td>                                    
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">Rp.{{ $data->total }}</p>
                          </td>                                     
                         
                          <td class="border-bottom-0">
                            
                                    <form action="{{ route('user.rencana-detail.destroy', ['rencana_id' => $rencana_id, 'subbagian' =>  $subbagian->id, 'rencana_detail' => $data->id]) }}" method="POST">
                                      @csrf
                                      @method('DELETE')                
                                      <button type="submit" class="dropdown-item d-flex align-items-center gap-3 text-danger show_confirm"><i class="fs-4 ti ti-trash"></i></button>
                                    </form>
                                 
                          </td>                    
                        </tr>    
                        @empty
                        <tr>
                          <td colspan="10">
                            <div class="alert alert-danger text-center" role="alert">
                                Data Uraian Kegiatan Kosong.
                            </div>
                          </td>
                        </tr>                
                        @endforelse
                      </tbody>
                    </table>
                      <div class="mt-3">
                        {{ $rencanadetailkegiatan->withQueryString()->links('pagination::bootstrap-5') }}                     
                      </div>   
                    </div>               
              </div>
            </div>

           




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
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

<script>
   function ribuan(string) {
    var myinput = document.getElementById(string);
    myinput.addEventListener('keyup', function() {
      var val = this.value;
      val = accounting.formatNumber(val);              
      this.value = val;
    });
  }
  ribuan("harga");

  $( '#pilih_kegiatan' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    selectionCssClass: 'select2--small',
    dropdownCssClass: 'select2--small',
} );
  $( '#pilih_sasaran' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    selectionCssClass: 'select2--small',
    dropdownCssClass: 'select2--small',
} );
  $( '#pilih_sumber' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    selectionCssClass: 'select2--small',
    dropdownCssClass: 'select2--small',
} );
  $( '#pilih_satuan' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    selectionCssClass: 'select2--small',
    dropdownCssClass: 'select2--small',
} );

$( document ).ready(function() {
  
 $('.show_confirm').click(function(event) {
    var form =  $(this).closest("form");
    event.preventDefault();
    swal({
              title: "Hapus Data Terpilih?",
              text: "Jika hapus data ini, maka data tersebut tidak bisa dikembalikan lagi.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
      }
    });
  });
});
</script>
@endsection


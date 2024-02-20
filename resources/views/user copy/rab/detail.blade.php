@extends('user.sidebar')
@section('title')Rencana Anggaran Belanja - RAB - Detail - {{ Auth::user()->type }} @endsection


@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp

  <div class="container">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Rencana Anggaran Belanja - RAB
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Detail
              </h4>
              <div class="card mb-0">
                <div class="card-body p-4">
                <!-- ISI START -->
                
                      <a href="{{ route('user.rencana.index') }}" class="btn btn-dark m-1">Kembali</a>
                      <a href="{{ route('user.rencana-detail.history', $id) }}" target="_blank" class="btn btn-outline-success m-1">History</a>
                      <a href="{{ route('user.rencana-detail.index', $id) }}" class="btn btn-outline-primary m-1">Segarkan</a>                
                      <a class="btn btn-outline-danger m-1 position-absolute end-0 me-4 show_confirm" href="{{ route('user.rencana-detail.closed', $id) }}">
                          Closed?
                      </a>
                        <form id="closed-form" action="{{ route('user.rencana-detail.closed', $id) }}" method="POST" class="d-none">
                          @csrf
                        </form>
                          
                
                <hr>
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif
                 
                  <div class="d-flex align-items-center gap-4 p-1 mb-3 rounded bg-info-subtle shadow-none" style="overflow: auto;">
                    <div class="position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-check" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /><path d="M15 19l2 2l4 -4" /></svg>
                    </div>                   
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                        {{ $rencana->unit }}
                      </h5>
                      <span class="fw-bold">Unit</span>
                    </div>
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                        {{ $rencana->tahun }}
                      </h5>
                      <span class="fw-bold">Tahun Anggaran</span>
                    </div>
                     <div class="pe-5">
                      <h5 class="fw-semibold">
                          {{ 'Rp. '.$rencana->anggaran }}
                      </h5>
                      <span class="fw-bold">Besaran Anggaran</span>
                    </div>
                     <div class="pe-5">
                      <h5 class="fw-semibold">
                           {{ 'Rp. '.number_format($rencana->grandtotal,0,",",".") }}
                      </h5>
                      <span class="fw-bold">Rencana Anggaran</span>
                    </div>
                  </div>
           
                <div class="table-responsive  rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle ">
                    <thead class="text-dark fs-4" style="position:sticky;top:0;">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>
                         <th class="border-bottom-0 fw-semibold mb-0 text-white">         
                              Unit
                        </th>
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Kode                       
                        </th>                       
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Uraian Kegiatan                       
                        </th>                                                                                       
                       <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Jumlah Sasaran                       
                        </th>                                                                                                                                    
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Harga Satuan                     
                        </th>
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Volume                       
                        </th>                          
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Jumlah Harga                       
                        </th>                          
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($bagian as $data)
                      <tr class="bg-primary-subtle">    
                        <td class="">
                          <h6 class="fw-bold mb-0">{{ $loop->iteration}}</h6>
                        </td>   
                        <td class="">
                          <p class="mb-0 fw-normal"></p>
                        </td> 
                        <td class="">
                          <p class="mb-0 fw-normal"></p>
                        </td> 
                        <td class="" colspan="5">
                          <p class="mb-0 fw-bold"> {{ $data->bagian}}</p>
                        </td>                         
                      </tr>    
                        @forelse ($data->subbagians as $data2)
                          <tr class="fw-bold">    
                                <td class="bg-primary-subtle" colspan="2"></td>
                                <td class="border-bottom-0">
                                  <p class="mb-0 fw-bold"> {{ $loop->parent->iteration }}.{{ $loop->iteration }} </p>
                                </td> 
                                <td class="border-bottom-0"> 
                                  <a href="{{ route('user.rencana-detail.create', ['rencana_id' => $id, 'subbagian' => $data2->id]) }}" class="btn mb-1 bg-primary-subtle me-2 btn-sm d-inline-flex align-items-center justify-content-center">
                                    <i class="fs-5 ti ti-playlist-add text-primary"></i> 
                                  </a> {{ $data2->subbagian }} 
                                </td>                                                                    
                                 <td colspan="3"></td>
                                 <td class="bg-info border-bottom-0">
                                  <h6 class="fw-bold text-white"> 
                                      {{ 'Rp. '.number_format($data2->totalsubbagian,0,",",".") }} 
                                  </h6>
                                </td>
                              </tr>                                  
                                  @forelse($data2->kegiatan as $data3)
                                            <tr>                                              
                                              <td class="bg-primary-subtle border-0"></td>
                                              <td class="bg-info text-white border-0">  {{ $rencana->unit }} </td>
                                              <td class="bg-info text-white border-0 text-end">{{ $data->index+1 }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                              <td class="bg-info text-white border-0">
                                                {{ $data3->nama_kegiatan }}
                                              </td>
                                                 <td class="bg-info text-white border-0 text-center">{{ $data3->jumlah_sasaran }}</td>
                                              <td class="bg-info text-white border-0"> {{ 'Rp. '.$data3->harga }} </td>
                                              <td class="bg-info text-white border-0 text-center">{{ $data3->volume }}</td>
                                              <td class="bg-info text-white border-0"> {{ 'Rp. '.$data3->total }}</td>
                                            </tr>                                              
                                  @empty
                                            <tr class="bg-primary-subtle">
                                              <td colspan="3"> </td>                                              
                                              <td colspan="5" class="">
                                               <div class="alert alert-danger" role="alert">
                                                    Data Uraian Kegiatan Kosong. 
                                                </div>
                                              </td>
                                            </tr>
                                  @endforelse
                                  <tr class="bg-primary-subtle" >
                                    <td colspan="9" class="border-0 p-0 pb-3" style="height:1px !important;"></td>
                                  </tr>

                                   

                        @empty
                           <tr>
                            <td colspan="2" class="bg-primary-subtle"></td>
                            <td colspan="6">
                              <div class="alert alert-danger text-center" role="alert">
                                  Data Sub Bagian {{ $data->bagian}} Kosong. <br> Silahkan Hubungi Admin.
                              </div>
                            </td>
                          </tr>  
                        @endforelse
                        <tr class="bg-primary" >
                                    <td colspan="9" class="border-0 p-0 pb-3" style="height:1px !important;"></td>
                                  </tr>
                      @empty
                      <tr>
                        <td colspan="8">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Rencana Anggaran Belanjan Kosong. <br> Silahkan Hubungi Admin.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
                    </tbody>
                  </table>
                                
                </div>
                <!-- ISI END -->
                </div>
              </div>        
        </div>        
@endsection

@section('jsSidebar')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script>
$( document ).ready(function() {
 $('.show_confirm').click(function(event) {                            
    var form =  document.getElementById('closed-form');
    event.preventDefault();
    swal({
              title: "Closed RAB?",
              text: "Jika anda closed sekarang, maka rencana anggaran belanja tidak bisa dibuka atau diakses kembali.",
              icon: "warning",
              buttons: ["Cancel", "Oke. Closed!"],
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
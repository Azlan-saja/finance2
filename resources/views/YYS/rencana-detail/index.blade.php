@extends('yys.sidebar')
@section('title')Rencana Anggaran Belanja - RAB - Detail - YYS @endsection


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
                <a href="{{ route('rencana.index') }}" class="btn btn-dark m-1">Kembali</a>
                <a href="{{ route('rencana-detail.index', $id) }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <hr>
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif
                 
                  <div class="d-flex align-items-center gap-4 p-1 mb-3 rounded bg-info-subtle shadow-none">
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
                          {{ $rencana->anggaran }}
                      </h5>
                      <span class="fw-bold">Besaran Anggaran</span>
                    </div>
                     <div class="pe-5">
                      <h5 class="fw-semibold">
                          Rp. 0
                      </h5>
                      <span class="fw-bold">Rencana Anggaran</span>
                    </div>
                  </div>
           
                <div class="table-responsive rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('subbagian.index',['id' => $id,'sort' => 'subbagian', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Unit
                            </a>
                        </th>
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Kode                       
                        </th>                       
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Uraian Kegiatan                       
                        </th>                                                                                       
                        <th class="border-bottom-0 fw-semibold mb-0 text-white">  
                          Keterangan                       
                        </th>                       
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($bagian as $data)
                      <tr class="bg-primary-subtle">    
                        <td class="border-bottom-0">
                          <h6 class="fw-bold mb-0">{{ $loop->iteration}}</h6>
                        </td>   
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"></p>
                        </td> 
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"></p>
                        </td> 
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-bold"> {{ $data->bagian}}</p>
                        </td> 
                        <td ></td>
                      </tr>    
                        @forelse ($data->subbagians as $data2)
                          <tr class="fw-bold">    
                                <td class="bg-primary-subtle"></td>
                                <td class="border-bottom-0">
                                  {{ $rencana->unit }}
                                </td>                                   
                                <td class="border-bottom-0">
                                  <p class="mb-0 fw-bold"> {{ $loop->parent->iteration }}.{{ $loop->iteration }} </p>
                                </td> 
                                <td class=""> 
                                  <a href="{{ route('rencana-detail.create', ['rencana_id' => $id, 'subbagian' => $data2->id]) }}" class="btn mb-1 bg-primary-subtle me-2 btn-sm d-inline-flex align-items-center justify-content-center">
                                    <i class="fs-5 ti ti-playlist-add text-primary"></i> 
                                  </a> {{ $data2->subbagian}}                                
                                </td>                                                                    
                                 <td colspan="8"></td>
                              </tr>                                    
                        @empty
                           <tr>
                            <td colspan="2"></td>
                            <td colspan="3">
                              <div class="alert alert-danger text-center" role="alert">
                                  Data Sub Bagian {{ $data->bagian}} Kosong.
                              </div>
                            </td>
                          </tr>  
                        @endforelse
                      @empty
                      <tr>
                        <td colspan="2"></td>
                        <td colspan="3">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Rencana Anggaran Belanjan Kosong.
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
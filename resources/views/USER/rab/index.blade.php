@extends('user.sidebar')
@section('title')Rencana Anggaran Belanja - RAB - {{ Auth::user()->type }} @endsection


@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp
  <div class="container mt-4">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Rencana Anggaran Belanja - RAB</h4>
              <div class="card mb-0">
                <div class="card-body p-4">
                <!-- ISI START -->
                <a href="{{ route('user.rencana.index') }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <hr>
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

                  <form action="{{ route('user.rencana.search') }}" method="POST">
                     @csrf               
                    <div class="input-group mb-3">
                      <input type="text" class="form-control @error('cari') is-invalid @enderror" placeholder="Pencarian" name="cari" required>                      
                      <button class="btn bg-primary-subtle text-primary rounded-end font-medium" type="submit">
                        Cari
                      </button> 
                      @error('cari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                   </span>
                      @enderror
                    </div>
                  </form>
                     
                <div class="table-responsive rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>
                        <th class="border-bottom-0">
                           <a class="fw-semibold mb-0 text-white" href="{{ route('user.rencana.index', ['sort' => 'anggaran', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Besar Anggaran
                            </a>
                        </th>
                        <th class="border-bottom-0">
                           <a class="fw-semibold mb-0 text-white" href="{{ route('user.rencana.index', ['sort' => 'unit', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Ke Unit
                            </a>
                        </th>
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('user.rencana.index', ['sort' => 'tahun', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Tahun Anggaran
                            </a>
                        </th>
                         <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('user.rencana.index', ['sort' => 'status', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Status
                            </a>
                        </th>
                        <th class="border-bottom-0">                         
                        </th>                       
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($rencana as $data)
                      <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-normal mb-0">{{ ++$i }}</h6>
                        </td>                     
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">  Rp. {{ $data->anggaran }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $data->unit }}</p>
                        </td>
                         <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->tahun }}</p>
                        </td>
                         <td class="border-bottom-0">
                          <span class="mb-1 badge rounded-pill {{ $data->status == 'Open' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $data->status }} </span>
                        </td>
                           <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <div class="dropdown dropstart">
                              <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu mt-0 pt-0" aria-labelledby="dropdownMenuButton">
                                 <li>
                                  <span class="bg-dark dropdown-item d-flex align-items-center gap-3 text-white text-center">Rp. {{$data->anggaran }}</span>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3 text-primary" href="{{ route('user.rencana-detail.index',$data->id) }}"><i class="fs-4 ti ti-calendar-plus"></i>Rencana</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3 text-success" href="{{ route('user.realisasi.index',$data->id) }}"><i class="fs-4 ti ti-calendar-week"></i>Realisasi</a>
                                </li>
                                                              
                              </ul>
                            </div>
                             
                          </div>
                        </td>                     
                      </tr>    
                      @empty
                      <tr>
                        <td colspan="6">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Rencana Anggaran Belanja Kosong.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
                    </tbody>
                  </table>
                  <div class="mt-3">
                     {{ $rencana->withQueryString()->links('pagination::bootstrap-5') }}                     
                                       
                  </div>                  
                </div>
                <!-- ISI END -->
                </div>
              </div>        
        </div>        
@endsection


@section('jsSidebar')

@endsection


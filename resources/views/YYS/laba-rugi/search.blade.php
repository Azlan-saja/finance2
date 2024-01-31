@extends('yys.sidebar')
@section('title')Laporan Laba Rugi - YYS @endsection

@section('cssSidebar')

@endsection

@section('pages')
  <div class="container">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Laporan Laba Rugi
              </h4>
              <div class="card mb-0">
                <div class="card-body p-4" >
                <!-- ISI START -->
                <a href="{{ route('laba-rugi.index') }}" class="btn btn-dark m-1">Kembali</a>
                <hr>

             
                  <div class="d-flex align-items-center gap-4 p-1 mb-3 rounded bg-info-subtle shadow-none" style="overflow: auto;">
                    <div class="position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-check" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /><path d="M15 19l2 2l4 -4" /></svg>
                    </div>                   
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                         {{ $unit }}
                      </h5>
                      <span class="fw-bold">Unit</span>
                    </div>
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                         {{ $tahun }}
                      </h5>
                      <span class="fw-bold">Tahun Anggaran</span>
                    </div>                   
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                          {{ 'Rp. '.number_format($pemasukan['total'],0,",",".") }}
                      </h5>
                      <span class="fw-bold">Total Pemasukan</span>
                    </div>                   
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                         {{ 'Rp. '.number_format($pengeluaran['total'],0,",",".") }}
                      </h5>
                      <span class="fw-bold">Total Pengeluaran</span>
                    </div>                   
                    <div class="pe-5">
                       <h5 class="fw-semibold">
                         {{ 'Rp. '.number_format($pendapatan,0,",",".") }}
                      </h5>
                      <span class="fw-bold">Total Pendapatan</span>
                    </div>                   
                  </div>
           
                 
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex">
                          <div class="p-6 bg-primary text-white rounded-2 me-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrows-down fs-6"></i> &nbsp; Pemasukkan
                          </div>                          
                        </div>
                         <div class="table-responsive rounded-2 mb-4">
                          <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">
                            <thead class="text-dark fs-4">
                              <tr class="bg-primary">
                                <th class="border-bottom-0 frezz">
                                  <span class="fw-semibold mb-0 text-white align-middle">#</span>
                                </th>                                                                
                                <th class="border-bottom-0 frezz fw-semibold mb-0 text-white text-wrap align-middle">  
                                  Nama Pemasukan                     
                                </th>                                                                                       
                                <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">  
                                  Besaran                       
                                </th>                                                                                                                                    
                              </tr>
                            </thead>
                            <tbody>
                           @forelse ($pemasukan['data'] as $pemasukans)
                              <tr>    
                                <td class="border-bottom-0">
                                  <h6 class="fw-bold mb-0">
                                    {{ $loop->index+1 }}
                                  </h6>
                                </td>             
                                <td class="border-bottom-0 text-wrap">
                                  <p class="mb-0 fw-bold">
                                    {{ $pemasukans->nama }}
                                  </p>
                                </td>                        
                                <td class="border-bottom-0">
                                  <h6 class="fw-bold"> 
                                    {{ 'Rp. '.$pemasukans->nominal }}
                                  </h6>
                                </td>   
                              </tr>
                               @empty
                               <tr>
                                <td colspan="3">
                                  <div class="alert alert-danger text-center" role="alert">
                                      Data Pemasukan Kosong.
                                  </div>
                                </td>
                              </tr>                
                              @endforelse                                        
                            </tbody>
                            <tfoot>
                              <tr class="bg-dark">
                                <td colspan="2" class="text-end">
                                  <h6 class="fw-bold fs-5 text-primary"> 
                                    Total Keseluruhan
                                  </h6>                                  
                                </td>
                               <td>
                                  <h6 class="fw-bold fs-5 text-primary"> 
                                    {{ 'Rp. '.number_format($pemasukan['total'],0,",",".") }}
                                  </h6>
                                </td>    
                              </tr>
                            </tfoot>
                          </table>                                
                        </div>                    
                    </div>

                    <div class="col-lg-6">
                      <div class="d-flex">
                          <div class="p-6 bg-danger text-white rounded-2 me-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrows-down fs-6"></i> &nbsp; Pengeluaran
                          </div>                          
                        </div>
                         <div class="table-responsive rounded-2 mb-4">
                            <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">                 
                            <thead class="text-dark fs-4">
                              <tr class="bg-danger">
                                <th class="border-bottom-0 frezz">
                                  <span class="fw-semibold mb-0 text-white align-middle">#</span>
                                </th>                                                                
                                <th class="border-bottom-0 frezz fw-semibold mb-0 text-white text-wrap align-middle">  
                                  Nama Pengeluaran                     
                                </th>                                                                                       
                                <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">  
                                  Besaran                       
                                </th>                                                                                                                                    
                              </tr>
                            </thead>
                            <tbody>
                           @forelse ($pengeluaran['data'] as $pengeluarans)
                              <tr>    
                                <td class="border-bottom-0">
                                  <h6 class="fw-bold mb-0">
                                    {{ $loop->index+1 }}
                                  </h6>
                                </td>             
                                <td class="border-bottom-0 text-wrap">
                                  <p class="mb-0 fw-bold">
                                    {{ $pengeluarans['nama'] }}
                                  </p>
                                </td>                        
                                <td class="border-bottom-0">
                                  <h6 class="fw-bold"> 
                                    {{ 'Rp. '.number_format($pengeluarans['nominal'],0,",",".") }}
                                  </h6>
                                </td>   
                              </tr>
                               @empty
                               <tr>
                                <td colspan="3">
                                  <div class="alert alert-danger text-center" role="alert">
                                      Data Penggeluaran Kosong.
                                  </div>
                                </td>
                              </tr>                
                              @endforelse                                        
                            </tbody>
                            <tfoot>
                              <tr class="bg-dark">
                                <td colspan="2" class="text-end">
                                  <h6 class="fw-bold fs-5 text-danger"> 
                                    Total Keseluruhan
                                  </h6>                                  
                                </td>
                               <td>
                                  <h6 class="fw-bold fs-5 text-danger"> 
                                    {{ 'Rp. '.number_format($pengeluaran['total'],0,",",".") }}
                                  </h6>
                                </td>    
                              </tr>
                            </tfoot>
                          </table>                                
                        </div>                    
                    </div>
                  </div>

                  <div class="card bg-primary-subtle rounded-2">
                    <div class="card-body text-center">
                      <div class="d-flex align-items-center justify-content-center mb-4 pt-8">
                        <i class="ti ti-arrows-down fs-6"></i>
                      </div>
                      <h3 class="fw-semibold">{{ 'Rp. '.number_format($pendapatan,0,",",".") }}</h3>
                      <p class="fw-normal mb-4 fs-6">
                        Total Pendapatan
                      </p>             
                  </div>
                </div>


               
                <!-- ISI END -->
                </div>
              </div>        
        </div>        
@endsection

@section('jsSidebar')

@endsection
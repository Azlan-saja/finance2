@extends('yys.sidebar')
@section('title')Realisasi Anggaran - RAB - YYS @endsection




@section('cssSidebar')
<style>
  th:last-child, td:last-child
{
  position:sticky;
  right:-1px;
 
}
.frezz{
}

</style>
@endsection

@section('pages')
  <div class="container">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Realisasi Anggaran - RAB
              </h4>
              <div class="card mb-0">
                <div class="card-body p-4" >
                <!-- ISI START -->
                <a href="{{ route('rencana.index') }}" class="btn btn-dark m-1">Kembali</a>
                <!-- <button id="toggle" type="button" class="btn btn-outline-warning m-1">Full Layer</button> -->
                <a href="{{ route('realisasi.index', $rencana_id) }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <a href="{{ route('laporan.realisasi', $rencana_id) }}" target="_blank" class="btn btn-outline-danger m-1 position-absolute end-0 me-4">Cetak</a>                
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
                           {{ 'Rp. '.number_format($rencana->total_all,0,",",".") }}
                      </h5>
                      <span class="fw-bold">Realisasi Anggaran</span>
                    </div>
                     <div class="pe-5 bg-danger p-2 text-white rounded">
                      <h5 class="fw-semibold ">
                           {{ 'Rp.'.number_format(str_replace('.','',$rencana->anggaran) - $rencana->total_all,0,",",".") }}
                      </h5>
                      <span class="fw-bold">Sisa Anggaran</span>
                    </div>
                  </div>
            
                  <div class="alert alert-warning alert-dismissible rounded-pill  border-0 fade show text-middle" role="alert">
                    <button type="button" class="btn-close btn-close-primary" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center font-medium me-3 me-md-0 ">
                     <div class="spinner-grow spinner-grow-sm"></div> &nbsp;&nbsp; <i class="fs-5 ti ti-alert-triangle pe-2 "></i> <strong>Silahkan Geser Tabel Kekanan! </strong>
                     </div>
                  </div>     



                <div class="table-responsive  rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle ">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">
                          #
                        </th>                       
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">  
                          Kode                        
                        </th>                       
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white text-wrap align-middle">  
                          Uraian Kegiatan                       
                        </th>                                                                                       
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">  
                          Sasaran                       
                        </th>                                                                                       
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white text-wrap align-middle">  
                          Sumber Anggaran                       
                        </th>                                                                                                                   
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white text-wrap align-middle">  
                          Besar Anggaran                       
                        </th>
                        <th class="border-bottom-0 frezz fw-semibold mb-0 text-white align-middle">  
                          Volume                       
                        </th>    
                        @for ($i = 1; $i <= 12; $i++)
                        <th class="border-bottom-0 fw-semibold mb-0 text-white text-wrap align-middle">  
                          {{ $i }}                      
                        </th> 
                        @endfor                                                                                                                                         
                        <th class="border-bottom-0 bg-primary fw-semibold mb-0 text-white align-middle text-center">  
                          Total                       
                        </th>                       
                      </tr>
                    </thead>
                    <tbody class="draggable">
                    @forelse ($rencana->bagian as $index => $data)
                      <tr class="bg-primary-subtle">    
                        <td class="frezz">
                          <h6 class="fw-bold mb-0">{{ $loop->iteration}}</h6>
                        </td>                          
                        <td class="frezz">                          
                        </td> 
                        <td class="text-wrap frezz" colspan="4">
                          <p class="mb-0 fw-bold"> {{ $data->nama_bagian}}</p>
                        </td>              
                        <td colspan="13"></td>           
                        <td class="bg-danger-subtle border-bottom-0">
                          <h6 class="fw-bold"> 
                            {{ 'Rp. '.number_format($data->total_bagian,0,",",".") }}
                          </h6>
                        </td>                      
                      </tr>    
                     
                        @forelse ($data->subbgaian as $data2)
                          <tr class="fw-bold">    
                                <td class="bg-primary-subtle frezz"></td>
                                <td class="border-0 frezz">
                                  <p class="mb-0 fw-bold"> {{ $loop->parent->iteration }}.{{ $loop->iteration }} </p>
                                </td> 
                                <td class="border-0 text-wrap frezz" colspan="5"> 
                                   {{ $data2->nama_subbagian }} 
                                </td>            
                                <td colspan="3" class="frezz"></td>                                                        
                                 <td colspan="9" class="border-0"></td>
                                 <td class="bg-warning-subtle border-0">
                                  <h6 class="fw-bold"> 
                                      {{ 'Rp. '.number_format($data2->total_subbagian,0,",",".") }}
                                  </h6>
                                </td>
                              </tr>                                  
                                  @forelse($data2->kegiatan as $data3)
                                            <tr class="border-bottom">                                              
                                              <td class="bg-primary-subtle border-0 frezz"></td>
                                              <td class="bg-info text-white border-0 text-end frezz">{{ $index+1 }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                              <td class="bg-info text-white border-0 text-wrap frezz">
                                                {{ $data3->nama_kegiatan }}
                                                <br>
                                                
                                                
                                              </td>
                                              <td class="bg-info text-white border-0 text-wrap frezz">{{ $data3->sasaran }}</td>
                                              <td class="bg-info text-white border-0 text-wrap" frezz>{{ $data3->anggaran }}</td>
                                              <td class="bg-info text-white border-0">Rp.{{ number_format($data3->jumlah_sasaran * str_replace('.','',$data3->harga) * $data3->volume,0,",",".") }}</td>
                                              <td class="bg-info text-white border-0 text-center">{{ $data3->volume }}</td>
                                              @for ($i = 1; $i <= 12; $i++)
                                                  <td class="bg-info text-white border-0 border-start border-end">                                                 
                                                  <a href="{{ route('realisasi.create', ['rencana_id' => $rencana_id, 'kegiatan_id' => $data3->id, 'bulan' => $i]) }}" class="btn mb-1 bg-primary-subtle text-primary me-2 btn-sm d-inline-flex align-items-center justify-content-center">
                                                    {{ $i }}<i class="fs-5 ti ti-edit text-primary"></i> 
                                                  </a> 
                                                  @forelse($data3->realisasi as $data4)
                                                    <div class="d-none"> {{ $x = 'b'.$i}}</div>
                                                      @if ($data4->$x != 0)
                                                          {{ 'Rp. '.number_format($data4->$x,0,",",".") }}
                                                      @else
                                                          <u class="text-warning">Empty</u>
                                                      @endif
                                                  @empty
                                                   <u class="text-warning">Empty</u>
                                                  @endforelse                                    
                                                  </td>
                                              @endfor 

                                                                                                                       
                                              <td class="bg-danger text-white border-0">  {{ 'Rp. '.number_format($data3->total_realisasi,0,",",".") }} </td>
                                            </tr>                                              
                                  @empty
                                            <tr class="bg-primary-subtle">
                                              <td colspan="22"> </td>                                                                                          
                                            </tr>
                                  @endforelse
                                  <tr class="bg-primary-subtle" >
                                    <td colspan="21" class="border-0 p-0 pb-3" style="height:1px !important;"></td>
                                  </tr>

                        @empty
                           <tr>
                            <td colspan="2"></td>
                            <td colspan="10">
                              <div class="alert alert-danger text-center" role="alert">
                                  Data Sub Bagian {{ $data->bagian}} Kosong.
                              </div>
                            </td>
                          </tr>  
                        @endforelse
                      <tr class="bg-primary" >
                        <td colspan="19" class="border-0 p-0 pb-3" style="height:1px !important;"></td>
                        <td class="border-0 p-0 pb-3 bg-dark" style="height:1px !important;"></td>
                      </tr>   
                      @empty
                      <tr>
                        <td colspan="20">
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

@section('jsSidebar')  
  <script>
    let isMouseDown = false;
    let startX;
    let scrollLeft;
   const table = document.querySelector('.table-responsive');

    table.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - table.offsetLeft;
        scrollLeft = table.scrollLeft;
    });

    table.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - table.offsetLeft;
        const walk = (x - startX) * 2;
        table.scrollLeft = scrollLeft - walk;
    });

    table.addEventListener('mouseup', () => {
        isMouseDown = false;
    });
  </script>
@endsection
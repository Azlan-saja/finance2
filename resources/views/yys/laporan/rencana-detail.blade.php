@include('yys.laporan.head')
                  
    <div class="table-unit">
        <table>
            <thead>
                <tr> 
                    <th>{{ $rencana->unit }}</th>
                    <th>{{ $rencana->tahun }}</th>
                    <th>{{ 'Rp.'.$rencana->anggaran }}</th>
                    <th>{{ 'Rp.'.number_format($rencana->grandtotal,0,",",".") }}</th>
                                      
                </tr>
                <tr> 
                    <th>Unit</th>
                    <th>Tahun Anggaran</th>
                    <th>Besaran Anggaran</th>
                    <th>Rencana Anggaran</th>
                                      
                </tr>
            </thead>
        </table>
    </div>
                  
    <div class="table-container">
        <table>
            <thead>
                <tr> 
                    <th>#</th>
                    <th>Unit</th>
                    <th>Kode</th>
                    <th>Uraian Kegiatan</th>
                    <th>Sasaran </th>
                    <th> Sumber Anggaran </th>
                    <th> Satuan </th>
                    <th> Jumlah Sasaran</th>
                    <th> Harga Satuan</th>
                    <th> Volume</th>
                    <th> Jumlah Harga</th>
                                      
                </tr>               
            </thead>
            <tbody>
                @forelse ($rencana->bagian as $index => $data)
                      <tr>    
                        <td>
                          <p>{{ $loop->iteration}}</p>
                        </td>                          
                        <td colspan="2"></td> 
                        <td colspan="7"><p class="mb-0 fw-bold"> {{ $data->nama_bagian}}</p></td>                         
                        <td> <p class="fw-bold">{{ 'Rp.'.number_format($data->subtotal,0,",",".") }}</p></td>                      
                      </tr>    
                        @forelse ($data->subbgaian as $data2)
                          <tr>    
                                <td class="bg-primary-subtle" colspan="2"></td>
                                <td class="border-0">
                                  <p class="mb-0 fw-bold"> {{ $loop->parent->iteration }}.{{ $loop->iteration }} </p>
                                </td> 
                                <td class="border-0"> 
                                  <p> {{ $data2->nama_subbagian }} </p>
                                </td>                                                                    
                                 <td colspan="6" class="border-0"></td>
                                 <td class="bg-info border-0">
                                    <p > 
                                      {{ 'Rp.'.number_format($data2->subtotal2,0,",",".") }} 
                                    </p>
                                </td>
                              </tr>                                  
                                  @forelse($data2->kegiatan as $data3)
                                            <tr>                                              
                                              <td class="bg-primary-subtle border-0"></td>
                                              <td class="bg-info text-white border-0"> <p> {{ $rencana->unit }} </p></td>
                                              <td class="bg-info text-white border-0" style="text-align:right;"><p>{{ $index+1 }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }}</p></td>
                                              <td class="bg-info text-white border-0 text-wrap">
                                                <p>{{ $data3->nama_kegiatan }}</p>
                                              </td>
                                              <td class="bg-info text-white border-0"><p>{{ $data3->sasaran }}</p></td>
                                              <td class="bg-info text-white border-0 text-wrap"><p>{{ $data3->anggaran }}</p></td>
                                              <td class="bg-info text-white border-0"><p>{{ $data3->satuan }}</p></td>
                                              <td class="bg-info text-white border-0"><p>{{ $data3->jumlah_sasaran }}</p></td>
                                              <td class="bg-info text-white border-0"> <p>{{ 'Rp.'.$data3->harga }}</p> </td>
                                              <td class="bg-info text-white border-0"><p>{{ $data3->volume }}</p></td>
                                              <td class="bg-info text-white border-0"> <p>{{ 'Rp.'.$data3->total }}</p></td>
                                            </tr>                                              
                                  @empty
                                            <tr class="bg-primary-subtle">
                                              <td colspan="11"> </td>                                                                                          
                                            </tr>
                                  @endforelse
                                  <tr class="bg-primary-subtle" >
                                    <td colspan="11" class="border-0 p-0 pb-3" style="height:1px !important;"></td>
                                  </tr>

                        @empty
                           <tr>
                            <td colspan="2"></td>
                            <td colspan="9">
                              <div class="alert alert-danger text-center" role="alert">
                                  Data Sub Bagian {{ $data->bagian}} Kosong.
                              </div>
                            </td>
                          </tr>  
                        @endforelse
                      @empty
                      <tr>
                        <td colspan="11">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Rencana Anggaran Belanjan Kosong.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
            </tbody>
        </table>
    </div>
@include('yys.laporan.foot')

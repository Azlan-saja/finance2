@include('yys.laporan.head')
@forelse ($hasil as $hasils)
    <div class="table-unit" style="padding-top:3px;">
        <table>
            <thead>
                <tr> 
                    <th> {{ $hasils->unit }} </th>
                    <th> {{ $hasils->tahun }}</th>
                    <th>{{ 'Rp.'.number_format($hasils->total_pemasukan,0,",",".") }}</th>
                    <th>{{ 'Rp.'.number_format($hasils->total_pengeluaran,0,",",".") }}</th>
                    <th>{{ 'Rp.'.number_format($hasils->pendapatan,0,",",".") }}</th>
                                      
                </tr>
                <tr> 
                    <th>Unit</th>
                    <th>Tahun Anggaran</th>
                    <th>Total Pemasukan</th>
                    <th>Total Pengeluaran</th>
                    <th>Total Pendapatan</th>                                      
                </tr>
            </thead>
        </table>
    </div>

    <div class="table-container">
        <h3 style="padding:0px;margin:0px;">Pemasukan</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pemasukan</th>
                    <th>Besaran</th>                                      
                </tr>
            </thead>
            <tbody>
                 @forelse ($hasils->pemasukan['data'] as $pemasukans)
                <tr>
                    <td>{{ $loop->index+1 }}.</td>
                    <td>{{ $pemasukans->nama }}</td>
                    <td>{{ 'Rp.'.$pemasukans->nominal }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center"> Data Pemasukan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align:right;">Total Keseluruhan</td>
                    <td>                                  
                        {{ 'Rp.'.number_format($hasils->pemasukan['total'],0,",",".") }}
                    </td>    
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="table-container">
        <h3 style="padding:0px;margin:0px;">Pengeluaran</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengeluaran</th>
                    <th>Besaran</th>                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($hasils->pengeluaran['data'] as $pengeluarans)
                <tr>
                    <td>{{ $loop->index+1 }}.</td>
                    <td>{{ $pengeluarans['nama'] }}</td>
                    <td>{{ 'Rp.'.number_format($pengeluarans['nominal'],0,",",".") }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center"> Data Penggeluaran Kosong. </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align:right;">Total Keseluruhan</td>
                    <td>                                  
                        {{ 'Rp.'.number_format($hasils->pengeluaran['total'],0,",",".") }}
                    </td>    
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>

@empty
<strong> EMPTY </strong>
@endforelse   
<div class="page-break"></div>
 <div class="table-container">
        <h3 style="padding:0px;margin:0px;">Data Beban Tersedia</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Beban</th>
                    <th>Masa</th>                                      
                    <th>Besaran</th>                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($beban as $bebans)
                <tr>
                    <td>{{ $loop->index+1 }}.</td>
                    <td>{{ $bebans['nama'] }}</td>                    
                    <td>{{ $bebans['masuk'] .'-'. $bebans['akhir'] }}</td>   
                    <td>{{ 'Rp.'.number_format($bebans['besaran'],0,",",".") }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center"> Data Beban Kosong. </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;">Total Keseluruhan</td>
                    <td>                                  
                        {{ 'Rp.'.number_format($beban->sum('besaran'),0,",",".") }}
                    </td>    
                </tr>
            </tfoot>
        </table>
    </div>

@include('yys.laporan.foot')
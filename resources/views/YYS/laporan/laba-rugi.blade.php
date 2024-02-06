<!DOCTYPE html>
<html lang="en">
    @include('yys.laporan.head')
<body>
    <div class="pdf-content">
        <!-- Your content goes here -->
        <h2>{{ $title }}</h2>
        <p>{{ date('d/m/y')}}</p>
    </div>

    <div class="table-unit">
        <table>
            <thead>
                <tr> 
                    <th> {{ $unit }}</th>
                    <th> {{ $tahun }}</th>
                    <th>{{ 'Rp.'.number_format($pemasukan['total'],0,",",".") }}</th>
                    <th>{{ 'Rp.'.number_format($pengeluaran['total'],0,",",".") }}</th>
                    <th>{{ 'Rp.'.number_format($pendapatan,0,",",".") }}</th>
                                      
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
                 @forelse ($pemasukan['data'] as $pemasukans)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
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
                        {{ 'Rp.'.number_format($pemasukan['total'],0,",",".") }}
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
                @forelse ($pengeluaran['data'] as $pengeluarans)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
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
                        {{ 'Rp.'.number_format($pengeluaran['total'],0,",",".") }}
                    </td>    
                </tr>
            </tfoot>
        </table>
    </div>



</body>
</html>

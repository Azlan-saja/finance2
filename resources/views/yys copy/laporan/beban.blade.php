@include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th> Nama Beban</th>     
                    <th> Besaran Nilai</th>     
                    <th> Tahun Masuk</th>     
                    <th> Tahun Akhir</th>     
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ 'Rp. '.number_format($data->besaran,0,",",".") }}</td>
                    <td>{{ $data->masuk }}</td>
                    <td>{{ $data->akhir }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center"> Data Pemasukan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@include('yys.laporan.foot')
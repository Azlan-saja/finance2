<!DOCTYPE html>
<html lang="en">
    @include('yys.laporan.head')
<body>
    <div class="pdf-content">
        <!-- Your content goes here -->
        <h2>{{ $title }}</h2>
        <p>{{ date('d/m/y')}}</p>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Unit</th>
                    <th> Nama Pemasukan</th>     
                    <th> Sumber Masukan (Anggaran)</th>     
                    <th> Nominal</th>     
                    <th> Tanggal</th>     
                    <th> Tahun Ajaran</th>     
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->unit }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->sumber }}</td>
                    <td>{{ 'Rp.'.$data->nominal }}</td>
                    <td>{{ Carbon\Carbon::parse($data->tanggal)->format("d/m/Y") }}</td>
                    <td>{{ $data->tahun }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center"> Data Pemasukan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

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
                    <td colspan="2" class="text-center"> Data Pemasukan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

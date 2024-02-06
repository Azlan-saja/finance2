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
                    <th>Satuan</th>
                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->satuan }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center"> Data Satuan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

@include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Unit</th>
                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->type }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center"> Data Pengguna Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@include('yys.laporan.foot')
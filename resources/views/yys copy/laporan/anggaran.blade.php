@include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sumber Anggaran</th>
                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->anggaran }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center"> Data Anggaran Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@include('yys.laporan.foot')

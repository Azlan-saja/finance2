
@include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Unit</th>
                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($kegiatan as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->kegiatan }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center"> Data Kegiatan Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@include('yys.laporan.foot')

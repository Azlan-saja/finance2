@include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggaran</th>
                    <th>Unit</th>
                    <th>Tahun</th>
                                      
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->anggaran }}</td>
                    <td>{{ $data->unit }}</td>
                    <td>{{ $data->tahun }}</td>
                                  
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center"> Data Rencana Anggaran Belanja (RAB) Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@include('yys.laporan.foot')

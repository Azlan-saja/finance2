 @include('yys.laporan.head')
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bagian</th>                    
                    <th>Sub Bagian</th>                    
                </tr>
            </thead>
            <tbody>
                @forelse ($bagian as $data)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $data->bagian }}</td>                   
                    <td>
                        <ol style="margin:0px;padding:top;">
                        @forelse ($data->subbagians as $data2)
                                <li>{{ $data2->subbagian }}</li>                                                                         
                        @empty
                         -
                        @endforelse 
                        </ol>  
                    </td>                   
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center"> Data Bagian Kosong. </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
 @include('yys.laporan.foot')

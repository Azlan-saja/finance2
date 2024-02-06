<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document</title>
    <style>
     body {
        font-family: "Times New Roman", Times, serif;
    }

    .pdf-content {
        margin: 0px;
        padding: 0px;
    }

    h2 {
        color: #333;
        margin: 0px;
        padding: 0px;
    }

    p {
        color: #666;
        margin: 0px;
        padding: 0px;
        font-size:9px;
    }

    .table-container {
        width: 100%;
        margin: 0px;
        padding:0px;        
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table{
        border-collapse: collapse !important;
        border: 1px solid #2A3547;
        width: 100%;
        
    }
    /* Style for the table header */
    .table-container thead {
        background-color: #2A3547;
        color: #fff;
    }

    /* Style for the table header cells */
    .table-container th {
        padding: 10px;
        text-align: left;
        vertical-align: middle;
        font-size:12px;
    }

    /* Style for the table body rows */
    .table-container tbody tr:nth-child(even) {
        background-color: #EAEDF4;
    }

    /* Style for the table body cells */
    .table-container td {
        padding: 10px;
        border: 1px solid #EBF1F6;
        text-align: left;
        vertical-align: top;
    }

    /* Hover effect on table rows */
    .table-container tbody tr:hover {
        background-color: #e0e0e0;
    }

    .table-container {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container th,
    .table-container td {
        padding: 10px;
        text-align: left;
        word-wrap: break-word;
        /* or overflow-wrap: break-word; */
    }

    .page-number {
        text-align: center;
        margin-top: 20px;
    }

    .table-unit {
        width: 100%;
        margin: 0px;
        padding:0px;        
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    /* Style for the table header */
    .table-unit thead {
        background-color: #DDEBFF;
        color: black;
    }
    .table-unit thead tr:nth-child(even)  {
        font-size:12px;
    }

    /* Style for the table header cells */
    .table-unit th {
        padding: 0px 10px 3px 10px;
        text-align: left;
        vertical-align: top;
    }
    </style>
</head>

<body>
    <div class="pdf-content">
        <!-- Your content goes here -->
        <h2>{{ $title }}</h2>
        <p>{{ date('d/m/y')}}</p>
    
                  
    <div class="table-unit">
        <table>
            <thead>
                <tr> 
                    <th>{{ $rencana->unit }}</th>
                    <th>{{ $rencana->tahun }}</th>
                    <th>{{ 'Rp.'.$rencana->anggaran }}</th>
                    <th>{{ 'Rp.'.number_format($rencana->total_all,0,",",".") }}</th>
                                      
                </tr>
                <tr> 
                    <th>Unit</th>
                    <th>Tahun Anggaran</th>
                    <th>Besaran Anggaran</th>
                    <th>Realisasi Anggaran</th>
                                      
                </tr>
            </thead>
        </table>
    </div>
                  
    <div class="table-container">
        <table>
            <thead>
                <tr> 
                    <th>#</th>                    
                    <th>Kode</th>
                    <th>Uraian Kegiatan</th>
                    <th>Sasaran </th>
                    <th> Sumber Anggaran </th>
                    <th> Satuan </th>
                    @for ($i = 1; $i <= 12; $i++)
                    <th>  
                        {{ $i }}                      
                    </th> 
                    @endfor    
                    <th> Total</th>
                                      
                </tr>               
            </thead>
            <tbody>
                @forelse ($rencana->bagian as $index => $data)
                      <tr>    
                        <td >
                          <p>{{ $loop->iteration}}.</p>
                        </td>                          
                        <td >                          
                        </td> 
                        <td colspan="4">
                          <p > {{ $data->nama_bagian}}</p>
                        </td>              
                        <td colspan="12"></td>           
                        <td >
                          <p> 
                            {{ 'Rp.'.number_format($data->total_bagian,0,",",".") }}
                          </p>
                        </td>                      
                      </tr>    
                     
                        @forelse ($data->subbgaian as $data2)
                          <tr>    
                                <td ></td>
                                <td >
                                  <p > {{ $loop->parent->iteration }}.{{ $loop->iteration }}. </p>
                                </td> 
                                <td > 
                                   <p >{{ $data2->nama_subbagian }} </p>
                                </td>            
                                <td colspan="15" ></td>                                                        
                                 <td >
                                  <p> 
                                      {{ 'Rp.'.number_format($data2->total_subbagian,0,",",".") }}
                                  </p>
                                </td>
                              </tr>                                  
                                  @forelse($data2->kegiatan as $data3)
                                            <tr>                                              
                                              <td ></td>
                                              <td style="text-align:right;"><p> {{ $index+1 }}.{{ $loop->parent->iteration }}.{{ $loop->iteration }}.</p></td>
                                              <td >
                                                <p> {{ $data3->nama_kegiatan }}</p>
                                                <br>
                                                
                                                
                                              </td>
                                              <td ><p>{{ $data3->sasaran }}</p></td>
                                              <td ><p>{{ $data3->anggaran }}</p></td>
                                              <td ><p>{{ $data3->satuan }}</p></td>
                                              @for ($i = 1; $i <= 12; $i++)
                                                  <td>     
                                                  <p style="display:none;"> {{ $x = 'b'.$i}}</p>                                            
                                                  @forelse($data3->realisasi as $data4)
                                                  @if($data4->$x !=0)
                                                          <p>{{ number_format($data4->$x,0,",",".") }}</p>
                                                  @else
                                                    <p>-</p>
                                                  @endif
                                                  @empty
                                                   <p>-</p>
                                                  @endforelse                                    
                                                  </td>
                                              @endfor                                                                                                                        
                                              <td> <p>{{ 'Rp.'.number_format($data3->total_realisasi,0,",",".") }} </p></td>
                                            </tr>                                              
                                  @empty
                                            <tr >
                                              <td colspan="19"> </td>                                                                                          
                                            </tr>
                                  @endforelse
                                  <tr >
                                    <td colspan="19"  style="height:1px !important;"></td>
                                  </tr>

                        @empty
                           <tr>
                            <td colspan="2"></td>
                            <td colspan="9">
                              <div>
                                  Data Sub Bagian {{ $data->bagian}} Kosong.
                              </div>
                            </td>
                          </tr>  
                        @endforelse
                      <tr class="bg-primary" >
                        <td colspan="18" style="height:1px !important;"></td>
                        <td class="border-0 p-0 pb-3 bg-dark" style="height:1px !important;"></td>
                      </tr>   
                      @empty
                      <tr>
                        <td colspan="19">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Rencana Anggaran Belanjan Kosong.
                          </div>
                        </td>
                      </tr>                                 
                      @endforelse
            </tbody>
        </table>
    </div></div>
</body>
</html>

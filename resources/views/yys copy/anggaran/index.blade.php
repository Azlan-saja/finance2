@extends('yys.sidebar')
@section('title')Sumber Anggaran - YYS @endsection
 

@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp
  <div class="container mt-4">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Sumber Anggaran</h4>
              <div class="card mb-0">
                <div class="card-body p-4">
                <!-- ISI START -->
                <a href="{{ route('anggaran.create') }}" class="btn btn-primary m-1">Tambah</a>
                <a href="{{ route('anggaran.index') }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <a href="{{ route('laporan.anggaran') }}" target="_blank" class="btn btn-outline-danger m-1 position-absolute end-0 me-4">Cetak</a>                
                <hr>
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif
                  <form action="{{ route('anggaran.search') }}" method="POST">
                     @csrf               
                    <div class="input-group mb-3">
                      <input type="text" class="form-control @error('cari') is-invalid @enderror" placeholder="Pencarian" name="cari" required>                      
                      <button class="btn bg-primary-subtle text-primary rounded-end font-medium" type="submit">
                        Cari
                      </button> 
                      @error('cari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                   </span>
                      @enderror
                    </div>
                  </form>
                     
                <div class="table-responsive rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>                       
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('anggaran.index', ['sort' => 'anggaran', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Sumber Anggaran
                            </a>
                        </th>
                        <th class="border-bottom-0">                         
                        </th>                       
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($anggaran as $data)
                      <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-normal mb-0">{{ ++$i }}</h6>
                        </td>                                            
                         <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->anggaran }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <div class="dropdown dropstart">
                              <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu mt-0 pt-0" aria-labelledby="dropdownMenuButton">                               
                                <li>
                                  <span class="bg-dark  dropdown-item d-flex align-items-center gap-3 text-white text-center" >{{$data->anggaran }}</span>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3 text-warning" href="{{ route('anggaran.edit',$data->id) }}"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <form action="{{ route('anggaran.destroy',$data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')                
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-3 text-danger show_confirm"><i class="fs-4 ti ti-trash"></i>Delete</button>
                                  </form>
                                </li>
                              </ul>
                            </div>
                             
                          </div>
                        </td>                    
                      </tr>    
                      @empty
                      <tr>
                        <td colspan="4">
                          <div class="alert alert-danger text-center" role="alert">
                              Data anggaran Kosong.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
                    </tbody>
                  </table>
                  <div class="mt-3">
                     {{ $anggaran->withQueryString()->links('pagination::bootstrap-5') }}                     
                  </div>                  
                </div>
                <!-- ISI END -->
                </div>
              </div>        
        </div>        
@endsection


@section('jsSidebar')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script>
$( document ).ready(function() {
 $('.show_confirm').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
              title: "Hapus Data Terpilih?",
              text: "Jika hapus data ini, maka data tersebut tidak bisa dikembalikan lagi.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
      }
    });
  });
});
</script>
@endsection


@extends('yys.sidebar')
@section('title')Bagian - YYS @endsection


@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp
  <div class="container mt-4">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Bagian</h4>
              <div class="card mb-0">
                <div class="card-body p-4">
                <!-- ISI START -->
                <a href="{{ route('bagian.create') }}" class="btn btn-primary m-1">Tambah</a>
                <a href="{{ route('bagian.index') }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <hr>
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif
                  <form action="{{ route('bagian.search') }}" method="POST">
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
                  <table class="table table-border  text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>
                        <th class="border-bottom-0">
                           <a class="fw-semibold mb-0 text-white" href="{{ route('bagian.index', ['sort' => 'type', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Unit
                            </a>
                        </th>
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('bagian.index', ['sort' => 'bagian', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Bagian
                            </a>
                        </th>
                        <th class="border-bottom-0">                         
                        </th>                       
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($bagian as $types => $data)
                       <tr class="bg-primary-subtle">
                        <td class="">
                            <h6 class="fw-bold mb-0">{{$loop->iteration}}  </h6>
                        </td>                     
                        <td class="">
                          <p class="mb-0 fw-bold">                          
                              {{$types}}                                                              
                          </p>
                        </td>
                         <td class="">
                          <p class="mb-0 fw-normal d-none">  {{ $data->count() }}</p>
                        </td>
                        <td class="">                        
                        </td>                    
                      </tr>    
                        @forelse ($data as $datas)
                          <tr class="bg-white">
                            <td class="border-0">                              
                            </td>    
                            <td>
                               <h6 class="fw-bold mb-0 text-end">{{$loop->parent->iteration}}.{{$loop->iteration}}  </h6>
                            </td>
                            </td>
                            <td class="border-1">
                              <p class="mb-0 fw-normal"> {{$datas->bagian}}     </p>
                            </td>
                            <td class="border-1">                        
                            </td>                    
                          </tr>                              
                        @empty
                        <tr>
                        <td colspan="4">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Bagian Kosong.
                          </div>
                        </td>
                      </tr>     
                      @endforelse                       
                      @empty
                      <tr>
                        <td colspan="4">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Bagian Kosong.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
                    </tbody>
                  </table>
                  <div class="mt-3">
                     {{ $bagian->withQueryString()->links('pagination::bootstrap-5') }} 
                     <br>
                                       
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


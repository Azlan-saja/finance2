@extends('yys.sidebar')
@section('title')Pengguna - YYS @endsection

@section('cssSidebar')

@endsection

@section('pages')
@php
    $order = request()->input('order', 'asc');
@endphp
  <div class="container mt-4">
              <h4 class="fw-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
                Pengguna</h4>
              <div class="card mb-0">
                <div class="card-body p-4">
                <!-- ISI START -->
                <a href="{{ route('pengguna.create') }}" class="btn btn-primary m-1">Tambah</a>
                <a href="{{ route('pengguna.index') }}" class="btn btn-outline-primary m-1">Segarkan</a>
                <hr>
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif
                  <form action="{{ route('pengguna.search') }}" method="POST">
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
                     
                  <div class="alert alert-warning alert-dismissible  border-0 fade show text-middle pb-1" role="alert">
                    <button type="button" class="btn-close btn-close-primary" data-bs-dismiss="alert" aria-label="Close"></button>
                  <h4 class="alert-heading">
                    <div class="spinner-grow spinner-grow-sm"></div> &nbsp;&nbsp; <i class="fs-5 ti ti-alert-triangle pe-2 "></i> Informasi !!!
                  </h4>
                  <hr>
                  <ol  type="1">
                    <li> Semua Password  &nbsp;<strong>Pengguna Baru </strong> &nbsp;Disetting Otomatis Menjadi <strong>12345678</strong>.</li>
                    <li> Fitur <strong>Reset Password Pengguna Lama </strong>&nbsp;Disetting Otomatis Menjadi <strong>12345678</strong>.</li>
                    <li> Ketika Anda Login Menggunakan Password 123456, Silahkan Ubah Password Anda Menggunakan <strong>Fitur Ubah Password</strong> di Akun Masing-masing.</li>
                  </ol>                  
                </div>



                <div class="table-responsive rounded-2 mb-4">
                  <table class="table border text-nowrap customize-table mb-0 align-middle table-striped">
                    <thead class="text-dark fs-4">
                      <tr class="bg-dark">
                        <th class="border-bottom-0">
                          <span class="fw-semibold mb-0 text-white">#</span>
                        </th>                       
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('pengguna.index', ['sort' => 'name', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                             Nama
                            </a>
                        </th>                        
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('pengguna.index', ['sort' => 'email', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Email
                            </a>
                        </th>
                        <th class="border-bottom-0">                          
                            <a class="fw-semibold mb-0 text-white" href="{{ route('pengguna.index', ['sort' => 'type', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l4 -4l4 4m-4 -4v14" /><path d="M21 15l-4 4l-4 -4m4 4v-14" /></svg>  
                              Unit
                            </a>
                        </th>                                             
                        <th class="border-bottom-0">                         
                        </th>                       
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($pengguna as $data)
                      <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-normal mb-0">{{ ++$i }}</h6>
                        </td>                                            
                         <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->name }}</p>
                        </td>                        
                         <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->email }}</p>
                        </td>
                         <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->type }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <div class="dropdown dropstart">
                              <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu mt-0 pt-0" aria-labelledby="dropdownMenuButton">                               
                                <li>
                                  <span class="bg-dark  dropdown-item d-flex align-items-center gap-3 text-white text-center" >{{$data->email }}</span>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3 text-warning" href="{{ route('pengguna.edit',$data->id) }}"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <form action="{{ route('pengguna.destroy',$data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')                
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-3 text-danger show_confirm"><i class="fs-4 ti ti-trash"></i>Delete</button>
                                  </form>
                                </li>
                                 <li class="bg-dark">
                                  <form action="{{ route('pengguna.reset',$data->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')      
                                    <input type="hidden" name="email" id="email"  value="{{ $data->email }}">          
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-3 text-danger show_confirm_reset"><i class="fs-4 ti ti-password-fingerprint"></i>Reset Password</button>
                                  </form>
                                </li>

                              </ul>
                            </div>
                             
                          </div>
                        </td>                    
                      </tr>    
                      @empty
                      <tr>
                        <td colspan="7">
                          <div class="alert alert-danger text-center" role="alert">
                              Data Pengguna Kosong.
                          </div>
                        </td>
                      </tr>                
                      @endforelse
                    </tbody>
                  </table>
                  <div class="mt-3">
                     {{ $pengguna->withQueryString()->links('pagination::bootstrap-5') }}                     
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
 $('.show_confirm_reset').click(function(event) {
    var form =  $(this).closest("form");
    var email = form.find('input[name="email"]').val();
    event.preventDefault();
    swal({
              title: "Reset Password?",
              text: ". Password Dengan Email "+email+" Akan di Setting Ulang Menjadi 12345678",
              icon: "info",
              buttons: ["Cancel", "Oke. Reset!"],
              dangerMode: false,
    })
    .then((willReset) => {
      if (willReset) {
        form.submit();
      }
    });
  });
});
</script>
@endsection


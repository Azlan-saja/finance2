@extends('yys.sidebar')
@section('title')Ubah Password Saya - YYS @endsection

@section('cssSidebar')
@endsection


@section('pages')
<div class="container mt-4">
    <h4 class="fw-semibold mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 18l6 -6l-6 -6v12" /></svg>
        Ubah Password Saya
    </h4>
    <div class="card mb-0">
        <div class="card-body p-4">
            <!-- ISI START -->
                
                   @if ($message = Session::get('success'))
                         <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> {{ $message }} </strong>
                        </div>                           
                    @endif    

                 <form action="{{ route('pengguna-aktif.ubah') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2">Password Baru</label>                         
                              <div class="col-lg-10">
                                <input type="password" class="form-control  @error('password_baru') is-invalid @enderror" name="password_baru" required>
                                  @error('password_baru')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                                                                                                                         
                    <div class="mb-3">
                            <div class="row">
                                <label class="col-lg-2 form-label pt-2">Ulangi Password Baru</label>                         
                              <div class="col-lg-10">
                                <input type="password" class="form-control  @error('ulangi_password_baru') is-invalid @enderror" name="ulangi_password_baru" required>
                                  @error('ulangi_password_baru')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>                          
                            </div>
                    </div>                                                                                                                                                                                                                                   
                                                                                                                         
                    <div class="form-actions col-lg-10 ms-auto">
                        <button type="submit" class="btn btn-secondary me-6">Simpan Perubahan </button>
                        <button type="reset" class="btn bg-danger-subtle text-danger font-medium"> Ulangi </button>                
                    </div>
                </form>

            <!-- ISI END -->
        </div>
    </div>        
</div>        
@endsection



@section('jsSidebar')
<script src="{{ asset('assets/js/accounting.js') }}"></script>

<script>
      function ribuan(string) {
    var myinput = document.getElementById(string);
    myinput.addEventListener('keyup', function() {
      var val = this.value;
      val = accounting.formatNumber(val);              
      this.value = val;
    });
  }
  ribuan("besaran");

</script>
@endsection

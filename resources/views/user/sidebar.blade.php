@extends('layouts.app')
@section('css')
@yield('cssSidebar')
<style>
   .terbang{
    position: fixed;
    left: -1px;
    top: 25px;
    z-index: 1;
    border-radius:0px 10px 10px 0px;
    padding-right:8px;
  }
  .swal-modal .swal-text {
    text-align: center;
  }
  .swal-overlay {
     background-color: rgba(2, 0, 3, 0.45);
  }
</style>
@endsection

@section('content')
 <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>               
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar " data-simplebar="">
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer mt-2 text-center" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
          <ul id="sidebarnav" >
            <li class="nav-small-cap text-center ">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">STATUS</span>
            </li>
            <li class="sidebar-item text-center {{ request()->is('home') ? 'selected' : ''}}">
              <a class="btn btn-success" style="letter-spacing: 0.15em;" href="{{ url('home')}}" aria-expanded="false">               
                <span class="hide-menu">{{ Auth::user()->name }} [{{ Auth::user()->type }}]     </span>
              </a>
            </li>            
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">FITUR</span>
            </li>
            <li class="sidebar-item {{ request()->is('rencana*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('rencana')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">R A B</span>
              </a>
            </li>
           
            <li class="sidebar-item {{ request()->is('pemasukan*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('pemasukan')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-trending-up"></i>
                </span>
                <span class="hide-menu">Pemasukan</span>
              </a>
            </li>
            <li class="sidebar-item {{ request()->is('beban*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('beban')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-trending-down"></i>
                </span>
                <span class="hide-menu">Beban</span>
              </a>
            </li>         
            <li class="sidebar-item {{ request()->is('laba-rugi*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('laba-rugi')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-report-analytics"></i>
                </span>
                <span class="hide-menu">Laba Rugi</span>
              </a>
            </li>          
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Lainnya</span>
            </li>
           <li class="sidebar-item {{ request()->is('ubah-akun*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('ubah-akun')}}" aria-expanded="false">
                <span>
                 <i class="ti ti-user-edit"></i>
                </span>
                <span class="hide-menu">Ubah Akun</span>
              </a>
            </li>
            <li class="sidebar-item {{ request()->is('ubah-password*') ? 'selected' : ''}}">
              <a class="sidebar-link" href="{{ url('ubah-password')}}" aria-expanded="false">
                <span>
                 <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Ubah Password</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
            </li>

          </ul>
    
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
  <a class="fs-8 sidebartoggler terbang bg-dark" id="headerCollapse" href="javascript:void(0)">
    <i class="ti ti-menu-2 text-white"></i>
  </a>
  <div class="body-wrapper">
      @yield('pages')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>

  
</div>
@endsection

@section('js')
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
@yield('jsSidebar')
@endsection
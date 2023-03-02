<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if(auth()->user()->level == 'masyarakat')
    <a href="{{route('dashboard.masyarakat')}}" class="brand-link">
      @elseif(auth()->user()->level == 'admin')
      <a href="{{route('dashboard.admin')}}" class="brand-link">
        @elseif(auth()->user()->level == 'petugas')
        <a href="{{route('dashboard.petugas')}}" class="brand-link">
      @endif
      <span class="brand-text font-weight-light">Lelang Online</span>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (auth()->user()->level == 'petugas')
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            @elseif (auth()->user()->level == 'masyarakat')
            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            @elseif (auth()->user()->level == 'admin')
            <img src="{{ asset('adminlte/dist/img/user-gear.png')}}"alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="/profile" class="d-block">{{ Auth::user()->nama_petugas}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          @if (auth()->user()->level == 'petugas')
          <li class="nav-header">DATA BARANG</li>
          <li class="nav-item">
            <a href="/petugas/barang" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-header">DATA LELANG</li>
          <li class="nav-item">
            <a href="/petugas/lelang" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Lelang
              </p>
            </a>
          </li>
          <li class="nav-header">DATA PENAWARAN</li>
          <li class="nav-item">
            <a href="{{route('datapenawar.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Data Penawaran Lelang
              </p>
            </a>
          </li>
          <li class="nav-header">GENERATE LAPORAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Laporan Lelang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Laporan History</p>
                </a>
              </li>
            </ul>
          </li>
          @elseif (auth()->user()->level == 'admin')
          <li class="nav-header">DATA BARANG</li>
          <li class="nav-item">
            <a href="/admin/barang" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
             <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-header">DATA USERS</li>
          <li class="nav-item">
            <a href="/admin/users" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Users
              </p>
            </a>
          </li>
          <li class="nav-header">DATA PENAWARAN</li>
          <li class="nav-item">
            <a href="{{route('datapenawar.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Data Penawaran Lelang
              </p>
            </a>
          </li>
          <li class="nav-header">GENERATE LAPORAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Laporan Lelang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Laporan History</p>
                </a>
              </li>
            </ul>
          </li>
          @elseif (auth()->user()->level == 'masyarakat')
          <li class="nav-header">LIST LELANG</li>
          <li class="nav-item">
            <a href="masyarakat.listlelang" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                List Lelang
              </p>
            </a>
          </li>
          <li class="nav-header">DATA PENAWARAN</li>
          <li class="nav-item">
            <a href="{{route('masyarakatlelang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Data Penawaran Anda
              </p>
            </a>
          </li>

          @endif
          <li class="nav-item">
            <a href="/logout" class="nav-link">
            <i style='font-size:14px' class='fas'>&#xf048;</i>
                <p>LOGOUT</p>
              </i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
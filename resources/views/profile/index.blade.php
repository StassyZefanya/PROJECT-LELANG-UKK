@extends('template.master')

@section('judul')
<h1>Profile</h1>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if(auth()->user()->level == 'admin')
                    <img src="{{asset('adminlte/dist/img/avatar.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                    @else
                    <img src="{{asset('adminlte/dist/img/avatar.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                @endif
              </div>

              <h3 class="profile-username text-center">{{Auth::user()->nama_petugas}}</h3>

              <p class="text-muted text-center">{{Auth::user()->level}}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Penawaran</b> <a class="float-right">{{ $historyLelangs->where('users_id',Auth::user()->id)->count()}}</a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Details</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="details">
                    <form class="form-horizontal">
                      <div class="form-row">
                         <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control"readonly>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Telepon</label>
                            <input type="text" name="telepon" value="{{ Auth::user()->telepon }}"class="form-control"readonly>
                          </div>
                         </div>
                          <div class="form-group ">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ Auth::user()->nama_petugas }}" class="form-control"readonly></div>
                          <div class="form-group">
                            <label>Waktu dibuat</label>
                            <input type="text" name="created_at" value="{{ Auth::user()->created_at }}"class="form-control"readonly>
                          </div>
                          @if(Auth::user()->level == 'admin')
                          <a href="{{route('dashboard.admin')}}" class="btn btn-outline-info">Kembali</a>
                          @elseif(Auth::user()->level == 'petugas')
                          <a href="{{route('dashboard.petugas')}}" class="btn btn-outline-info">Kembali</a>
                          @elseif(Auth::user()->level == 'masyarakat')
                          <a href="{{route('dashboard.masyarakat')}}" class="btn btn-outline-info">Kembali</a>
                          @endif
                    </form>
                  </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
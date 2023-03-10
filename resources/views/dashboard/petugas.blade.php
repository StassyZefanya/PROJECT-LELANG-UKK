@extends('template.master')

@section('content')
<section class="content">
<h1>HALLO PETUGAS!</h1>
  @if(session()->has('successlogin'))
  <div class="alert alert-info col-md-5" role="alert">
    {{session('successlogin')}}Selamat datang <strong>{{Auth::user()->name}}</strong>
  </div>
  @endif
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Barang</span>
              <span class="info-box-number">
                {{ $barangs->count()}}
              </span>
              <a href="{{route('barang.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-gavel"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Lelang</span>
              <span class="info-box-number">
                {{ $lelangs->count()}}
              </span>
              <a href="petugas/lelang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Penawaran</span>
              <span class="info-box-number">
                {{ $historyLelangs->count()}}
              </span>
              <a href="{{route('datapenawar.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
    </div>
    <div class="card">
      <div class="card-header">
        <strong>Data Penawaran Lelang</strong> 
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
    <table class="table table-hover">
          <thead>
              <tbody>
                  <tr>
                      <th>No</th>
                      <th>Pelelang</th>
                      <th>Nama Barang</th>
                      <th>Harga Penawaran</th>
                      <th>Tanggal Penawaran</th>
                      <th>Status</th>
                      
                  </tr>
              </tbody>
          </thead>
          @forelse ($historyLelangs as $item)
          <tbody>
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{  $item->user->username}}</td>
              <td>{{ $item->lelang->barang->nama_barang }}</td>
              <td>{{$item->harga}}</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
              <td>
              <span class="badge {{ $item->status == 'pending' ? 'bg-warning' : ($item->status == 'gugur' ? 'bg-danger' : 'bg-success') }}">{{ Str::title($item->status) }}</span></td>
          </tr>
          @empty
          <tr>
              <td>Data masih kosong</td>
          </tr>
          @endforelse
          </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
</section>
@endsection
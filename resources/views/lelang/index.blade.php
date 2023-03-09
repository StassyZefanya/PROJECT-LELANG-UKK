@extends('template.master')

@section('judul')
<h1>Halaman Lelang</h1>
@endsection

@section('content')
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      @if (auth()->user()->level == 'petugas')
      <a type="button"  class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-lelang">
        Tambah Lelang
      </a>
      
      <!-- Modal Tambah Lelang -->
<div class="modal fade" id="modal-lelang" tabindex="-1" role="dialog" aria-labelledby="modal-lelang-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-lelang-label">Tambah Lelang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="POST" action="{{ route('lelang.store') }}" data-parsley-validate>
        @csrf
        <div class="modal-body">
          <div class="form-group mandatory">
            <label for="barangs_id" class="form-label">{{ __('Nama Barang') }}</label>
            <select class="form-select form-control @error('barangs_id') is-invalid @enderror" id="barangs_id" name="barangs_id" data-parsley-required="true">
              <option value="" selected>Pilih Barang</option>
              @forelse ($barangs as $item)
                <option value="{{ $item->id }}">{{ Str::of($item->nama_barang)->title() }} -  {{ Str::of($item->harga_barang)->title() }}</option>
              @empty
                <option value="" disabled>Barang Semuanya Sudah Di Lelang</option>
              @endforelse
            </select>
            @error('barangs_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mandatory">
            <label for="tanggal_lelang" class="form-label">{{ __('Tanggal Lelang') }}</label>
            <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" data-parsley-required="true" value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Batal') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('Tambah Lelang') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <a hidden class="btn btn-primary mb-3"href="/petugas/lelang/create">Tambah lelang</a>
    <a class="btn btn-info mb-3" target="_blank" href="{{route('cetak.lelang')}}">
      <li class="fas fa fa-print"></li>
      Cetak Data
    </a>
    @else
    @endif
    
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
                    <th>Nama Barang</th>
                    <th>Harga Awal</th>
                    <th>Harga Akhir</th>
                    <th>Pemenang</th>
                    <th>Status</th>
                    @if(Auth::user()->level == 'petugas')
                    <th></th>
                    @else
                    @endif
                    @if(auth()->user()->level == 'admin')
                    <th></th>
                    @else
                    @endif
                    
                </tr>
            </tbody>
        </thead>
        @forelse ($lelangs as $item)
        <tbody>
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->barang->nama_barang }}</td>
            <td>{{ $item->barang->harga_barang}}</td>
            <td>{{ $item->harga_akhir }}</td>
            <td>{{ $item->pemenang }}</td>
            <td>
              <span class="badge {{ $item->status == 'ditutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($item->status) }}</span>
            </td>
            @if (auth()->user()->level == 'admin')
            <td>
              <a class="btn btn-primary btn-sm" href="{{ route('lelangadmin.show', $item->id)}}">
                <i class="fas fa-folder">
                </i>
                View
              </a>
            </td>
            @endif
            @if (auth()->user()->level == 'petugas')
            <td>
            <form action="{{ route('lelang.destroy', [$item->id]) }}"method="POST">
            {{-- <a class="btn btn-primary"href="{{ route('barang.show', $item->id)}}">Detail</a>
            <a class="btn btn-warning"href="{{ route('barang.edit', $item->id)}}">Edit</a> --}}

            <a class="btn btn-primary btn-sm" href="{{ route('lelangpetugas.show', $item->id)}}">
              <i class="fas fa-folder">
              </i>
              View
          </a>
          <a class="btn btn-info btn-sm" href="{{ route('barang.edit', $item->barangs_id)}}">
              <i class="fas fa-pencil-alt">
              </i>
              Edit
          </a>
          </form>
        </td>
        @else
        @endif
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align: center" class="text-danger"><strong>Data masih kosong</strong></td>
        </tr>
        @endforelse
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
@endsection
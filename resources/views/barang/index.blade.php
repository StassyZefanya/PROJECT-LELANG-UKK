@extends('template.master')
<!-- @section('title', 'Data Barang') -->

@section('judul')

@section('content')

<section class="section">
  <div class="card">
      <div class="card-header d-flex justify-content-between">
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-md">{{ __('Tambah Barang') }}</a>
      </div>
      <div class="card-body">
          <table class="table table-striped" style="width: 100%" id="table1">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Harga Awal</th>
                      <th>Tanggal Input</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($barangs as $barang)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::of($barang->nama_barang)->title() }}</td>
                    <td>{{ $barang->harga_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->tanggal)->format('j-F-Y') }}</td>
                    <td>
                      <div class="d-flex flex-nowrap flex-column flex-md-row justify-center">
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-info btn-sm">
                          detail 
                        </a>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">
                          edit
                      </a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" value="delete" class="btn btn-danger btn-sm">
                            delete
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align: center" class="text-danger">Data Barang Kosong</td>
                  </tr>
                    
                @endforelse

              </tbody>
          </table>
      </div>
  </div>

</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endpush
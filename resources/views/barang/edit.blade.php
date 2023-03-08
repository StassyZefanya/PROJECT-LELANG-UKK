@extends('template.master')

@section('judul', 'Data Barang')

@section('subtitle', 'Data Barang Yang Akan Di Lelang')

@section('content')
<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{ __('Edit Data Barang Yang Akan Di Lelang') }}</h4>
              </div>
              <div class="card-content">
                  <div class="card-body">
                      <form class="form" method="POST" action="{{ route('barang.update', [$barangs->id]) }}" data-parsley-validate>
                        @csrf
                        @method('PUT')  
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="nama_barang" class="form-label">{{ __('nama_barang') }}</label>
                                    <input type="text" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="nama_barang" name="nama_barang" data-parsley-required="true" value="{{ old('nama_barang', Str::of($barangs->nama_barang)->title()) }}">
                                </div>
                                @error('nama_barang')
                                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="tanggal" class="form-label">{{ __('Tanggal') }}</label>
                                    <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal" name="tanggal" data-parsley-required="true" value="{{ old('tanggal', $barangs->tanggal) }}">
                                </div>
                                @error('tanggal')
                                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="harga_barang" class="form-label">{{ __('Harga Barang') }}</label>
                                    <input type="text" id="harga_barang" class="form-control @error('harga_barang') is-invalid @enderror" placeholder="Input Harga, Hanya Angka" name="harga_barang" data-parsley-required="true" value="{{ old('harga_barang', $barangs->harga_barang) }}">
                                </div>
                                @error('harga_awal')
                                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group mandatory">
                                <label for="deskripsi" class="form-label">{{ __('Deskripsi Barang') }}</label>
                                <div class="form-floating">
                                  <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" placeholder="Deskripsi Barang" id="deskripsi" name="deskripsi_barang">{{ old('deskripsi', Str::of($barangs->deskripsi)->title()) }}</textarea>
                                    <label for="deskripsi_barang">{{ __('Jelaskan deskripsi barang minimal 10 karakter') }}</label>
                                </div>
                              </div>
                                @error('deskripsi')
                                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-6 d-flex justify-content-start">
                                  <a href="{{ route('barang.index') }}" class="btn btn-outline-info me-1 mb-1">
                                    {{ __('Kembali') }}
                                  </a>
                              </div>
                            <div class="col-6 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                  {{ __('Submit') }}
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                  {{ __('Reset') }}
                                </button>
                            </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
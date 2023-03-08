@extends('template.master')

@section('judul', 'Data Barang')

@section('subtitle', 'Data Barang Yang Akan Di Lelang')

@section('content')
<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{ __('Detail data barang lelang') }}</h4>
                  <h2 class="fs-6 fw-lighter text-muted font-monospace">
                   </h2>
              </div>
              <div class="card-content">
                  <div class="card-body">
                        <div class="row">
                        
                        <!-- Profile Image -->
                        
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if ($databarang[0]->image)
                                        <img class="img-fluid mt-3" src="{{ asset('storage/' . $databarang[0]->image) }}"
                                            alt="User profile picture">
                                    @endif
                                </div>
                            </div>
                        <br>
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="nama_barang" class="form-label">{{ __('Nama Barang') }}</label>
                                    <input type="text" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Nama Barang" name="nama_barang" data-parsley-required="true" value="{{ Str::of($databarang[0]->nama_barang)->title() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="tanggal" class="form-label">{{ __('Tanggal') }}</label>
                                    <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal" name="tanggal" data-parsley-required="true" value="{{ $databarang[0]->tanggal }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mandatory">
                                    <label for="harga_awal" class="form-label">{{ __('Harga Awal') }}</label>
                                    <input type="text" id="harga_awal" class="form-control @error('harga_awal') is-invalid @enderror" placeholder="Input Harga, Hanya Angka" name="harga_awal" data-parsley-required="true" value="{{ Str::of($databarang[0]->harga_barang)->title() }}" disabled>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group mandatory">
                                <label for="deskripsi_barang" class="form-label">{{ __('deskripsi barang') }}</label>
                                <div class="form-floating">
                                  <textarea class="form-control @error('deskripsi_barang ') is-invalid @enderror" placeholder="deskripsi_barang" id="deskripsi_barang" name="deskripsi_barang" disabled>{{ Str::of($databarang[0]->deskripsi_barang )->title() }}</textarea>
                                    <label for="deskripsi_barang">{{ __('Jelaskan deskripsi barang minimal 10 karakter') }}</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-6 d-flex justify-content-start">
                                  <a href="{{ route('barang.index') }}" class="btn btn-outline-info me-1 mb-1">
                                    {{ __('Kembali') }}
                                  </a>

                              </div>
                            <div class="col-6 d-flex justify-content-end">
                                <a href="{{ route('barang.edit', $databarang[0]->id) }}" class="btn btn-warning me-1 mb-1">
                                  {{ __('Edit') }}
                                </a>
                            </div>
                          </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
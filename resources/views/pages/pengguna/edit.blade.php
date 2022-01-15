@extends('layouts.dashboard')

@section('title', 'Edit Pengguna')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Pengguna</h2>
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="post">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengguna</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_pengguna" class="form-control @error('nama_pengguna') is-invalid @enderror" value="{{ old('nama_pengguna') ?? $pengguna->nama_pengguna }}">
                            @error('nama_pengguna')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') ?? $pengguna->username }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                <option value="">&mdash; Pilih &mdash;</option>
                                @if (old('jabatan'))
                                    <option value="pemilik"
                                        @if (old('jabatan') == 'pemilik')
                                            selected
                                        @endif
                                        >Pemilik</option>
                                    <option value="kasir"
                                        @if (old('jabatan') == 'kasir')
                                            selected
                                        @endif
                                        >Kasir</option>
                                @else
                                    <option value="pemilik"
                                        @if ($pengguna->jabatan == 'pemilik')
                                            selected
                                        @endif
                                        >Pemilik</option>
                                    <option value="kasir"
                                        @if ($pengguna->jabatan == 'kasir')
                                            selected
                                        @endif
                                        >Kasir</option>
                                @endif
                            </select>
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
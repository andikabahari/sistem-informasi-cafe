@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Akun</h2>
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{ route('akun.update') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengguna</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_pengguna" class="form-control @error('nama_pengguna') is-invalid @enderror" value="{{ old('nama_pengguna') ?? $akun->nama_pengguna }}">
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
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') ?? $akun->username }}">
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
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') ?? $akun->password }}">
                            @error('password')
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
                            @if ($akun->jabatan == 'pemilik')    
                                <option value=pemilik selected>Pemilik</option>
                                <option value=kasir>Kasir</option>
                            @else
                                <option value=pemilik>Pemilik</option>
                                <option value=kasir selected>Kasir</option>
                            @endif
                            </select>
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
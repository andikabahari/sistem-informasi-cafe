@extends('layouts.dashboard')

@section('title', 'Tambah Menu')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Menu</h2>
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_pengguna" value="{{ \App\Helpers\MyAuth::id() }}">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Menu</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" value="{{ old('nama_menu') }}">
                            @error('nama_menu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" onchange="loadImage(event)">
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img id="gambar" class="mt-3" src="holder.js/200x200">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Aktif</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="aktif" class="form-control @error('aktif') is-invalid @enderror">
                                <option value="1"
                                    @if (old('aktif') === '1')
                                        selected
                                    @endif
                                    >Ya</option>
                                <option value="0"
                                    @if (old('aktif') === '0')
                                        selected
                                    @endif
                                    >Tidak</option>
                            </select>
                            @error('aktif')
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

@section('script')
<script>
    var loadImage = function(event) {
        var output = document.getElementById('gambar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    };
</script>
@endsection
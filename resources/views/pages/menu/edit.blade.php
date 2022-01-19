@extends('layouts.dashboard')

@section('title', 'Edit Menu')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Menu</h2>
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{ route('menu.update', $menu->id_menu) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id_pengguna" value="{{ \App\Helpers\MyAuth::id() }}">
                <input type="hidden" name="old_gambar" value="{{ $menu->gambar }}">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Menu</label>
                        <div class="col-sm-12 col-md-7">
                            @if (DB::table('detail_pesanan')->where('id_menu', $menu->id_menu)->exists())
                                <input type="text" class="form-control" value="{{ $menu->nama_menu }}" readonly>
                                <input type="hidden" name="nama_menu" value="{{ $menu->nama_menu }}">
                            @else
                                <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" value="{{ old('nama_menu') ?? $menu->nama_menu }}">
                                @error('nama_menu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                        <div class="col-sm-12 col-md-7">
                            @if (DB::table('detail_pesanan')->where('id_menu', $menu->id_menu)->exists())
                                <input type="text" class="form-control" value="{{ $menu->harga }}" readonly>
                                <input type="hidden" name="harga" value="{{ $menu->harga }}">
                            @else
                                <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') ?? $menu->harga }}">
                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @endif
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
                            @if ($menu->gambar)
                                <img id="gambar" class="mt-3" src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 200px; height: 200px">
                            @else
                                <img id="gambar" class="mt-3" src="holder.js/200x200">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Aktif</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="aktif" class="form-control @error('aktif') is-invalid @enderror">
                                @php var_dump(old('aktif')) @endphp
                                @if (old('aktif') === '0' || old('aktif') === '1')
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
                                @else
                                    <option value="1"
                                        @if ($menu->aktif > 0)
                                            selected
                                        @endif
                                        >Ya</option>
                                    <option value="0"
                                        @if ($menu->aktif == 0)
                                            selected
                                        @endif
                                        >Tidak</option>
                                @endif
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
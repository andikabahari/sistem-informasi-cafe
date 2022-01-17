@extends('layouts.dashboard')

@section('title', 'Daftar Menu')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Menu</h2>
        @include('partials.message')
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
                <div class="card-header-action">
                    <a href="{{ route('menu.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <th>#</th>
                            <th width="170">Gambar</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach ($menu as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($data->gambar)
                                            <img class="m-2" src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->nama_menu }}" style="width: 100px; height: 100px">
                                        @else
                                            <img class="m-2" src="holder.js/100x100/?text=Gambar">
                                        @endif
                                    </td>
                                    <td>{{ $data->nama_menu }}</td>
                                    <td>Rp{{ $data->harga }}</td>
                                    <td>{!! $data->aktif > 0 ? '<span class="badge badge-info">Ya</span>' : '<span class="badge badge-warning">Tidak</span>' !!}</td>
                                    <td>
                                        <div style="width: 125px">
                                            <a href="{{ route('menu.edit', $data->id_menu) }}" class="btn btn-success">Edit</a>
                                            @if (DB::table('detail_pesanan')->where('id_menu', $data->id_menu)->doesntExist())
                                                <form class="d-inline-block" action="{{ route('menu.delete', $data->id_menu) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">Hapus</a>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $menu->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
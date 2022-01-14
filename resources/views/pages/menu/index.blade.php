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
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach ($menu as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->gambar }}</td>
                                    <td>{{ $data->nama_menu }}</td>
                                    <td>{{ $data->harga }}</td>
                                    <td>
                                        <a href="{{ route('menu.edit', $data->id_menu) }}" class="btn btn-success">Edit</a>
                                        <form class="d-inline-block" action="{{ route('menu.delete', $data->id_menu) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Hapus</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
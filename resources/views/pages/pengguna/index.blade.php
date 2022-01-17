@extends('layouts.dashboard')

@section('title', 'Daftar Pengguna')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Pengguna</h2>
        @include('partials.message')
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
                <div class="card-header-action">
                    <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach ($pengguna as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_pengguna }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->jabatan }}</td>
                                    <td>
                                        <a href="{{ route('pengguna.edit', $data->id_pengguna) }}" class="btn btn-success">Edit</a>
                                        <form class="d-inline-block" action="{{ route('pengguna.delete', $data->id_pengguna) }}" method="post">
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
                <div>
                    {{ $pengguna->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
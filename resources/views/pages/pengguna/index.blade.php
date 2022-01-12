@extends('layouts.dashboard')

@section('title', 'Pengguna')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">@yield('title')</h2>
        <div class="card">
            <div class="card-header">
                <h4>Daftar @yield('title')</h4>
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
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
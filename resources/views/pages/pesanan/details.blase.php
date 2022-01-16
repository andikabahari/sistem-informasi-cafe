@extends('layouts.dashboard')

@section('title', 'Pesanan Baru')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Pesanan</h2>
        @include('partials.message')
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{ route('pesanan') }}" method="post">
                <div class="card-body">
                    <h4>DILEUBEUT</h4>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <span class="d-block">Nama</span>
                            <span class="d-block">John Cena</span>
                        </div>
                        <div class="col">
                            <span class="d-block">Tanggal</span>
                            <span class="d-block">7 Januari 2022</span>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Cetak</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
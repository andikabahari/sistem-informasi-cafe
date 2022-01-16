@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Riwayat Pesanan</h2>
        @include('partials.message')
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="container-fluid">
            <div class="row">
                @foreach($pesanan as $data)
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <p>{{$data->tanggal_pesanan}}</p>
                            <p>{{$data->nama_pelanggan}}</p>
                            <p>{{$data->nama_pelanggan}}</p>
                            <a href="#"  class="card-link text-right">detail pesanan</a>
                        </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
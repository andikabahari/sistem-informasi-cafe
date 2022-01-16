@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan')

@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Riwayat Pesanan</h2>
        @include('partials.message')
        <div class="row">
            @php
                setlocale(LC_TIME, 'IND')
            @endphp
            @foreach($pesanan as $data)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <p>{{ strftime('%d %B %Y', strtotime($data->tanggal_pesanan)) }}</p>
                            <p class="font-weight-bold">{{ $data->nama_pelanggan }}</p>
                            <p>Rp{{ $data->total }}</p>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <a href="{{ route('struk', $data->id_pesanan) }}"  class="card-link text-right">Detail pesanan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $pesanan->links() }}
        </div>
    </div>
</section>
@endsection
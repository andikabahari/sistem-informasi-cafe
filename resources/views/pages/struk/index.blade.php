@extends('layouts.dashboard')

@section('title', 'Struk Pesanan')

@section('content')
<section class="section">
    <div class="section-body">
        @include('partials.message')
        <div class="card mx-auto mt-5" style="max-width: 480px">
            <form action="{{ route('pesanan') }}" method="post">
                <div id="print">
                    <div class="card-body">
                        <h4 class="text-center text-uppercase mt-3">{{ config('app.name') }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <span class="d-block">Nama</span>
                                <span class="d-block font-weight-bold">{{ $pesanan->nama_pelanggan }}</span>
                            </div>
                            <div class="col">
                                <span class="d-block">Tanggal</span>
                                @php
                                    setlocale(LC_TIME, 'IND')
                                @endphp
                                <span class="d-block font-weight-bold">{{ strftime('%d %B %Y', strtotime($pesanan->tanggal_pesanan)) }}</span>
                            </div>
                        </div>
                        <hr>
                            @foreach ($detailPesanan as $data)
                                <div class="row">
                                    <div class="col">
                                        <div class="d-block font-weight-bold">{{ $data->nama_menu }}</div>
                                        <div class="d-block">Rp{{ $data->harga }}</div>
                                    </div>
                                    <div class="col text-center font-weight-bold">
                                        <span>x {{ $data->banyak }}</span>
                                    </div>
                                    <div class="col text-right font-weight-bold">
                                        <span>Rp{{ $data->banyak * $data->harga }}</span>
                                    </div>
                                </div>
                            @endforeach
                        <hr>
                        <div class="row">
                            <div class="col">Total Harga</div>
                            <div class="col text-right font-weight-bold">Rp{{ $pembayaran->total }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Tunai</div>
                            <div class="col text-right font-weight-bold">Rp{{ $pembayaran->tunai }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Kembali</div>
                            <div class="col text-right font-weight-bold">Rp{{ $pembayaran->kembali }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" onclick="printDiv('print')">Cetak Struk</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
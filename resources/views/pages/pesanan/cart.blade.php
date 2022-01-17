@extends('layouts.dashboard')

@section('title', 'Daftar Keranjang')

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
                @csrf
                <input type="hidden" name="id_pengguna" value="{{ \App\Helpers\MyAuth::id() }}">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pelanggan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}">
                            @error('nama_pelanggan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pesanan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="date" name="tanggal_pesanan" class="form-control @error('tanggal_pesanan') is-invalid @enderror" value="{{ old('tanggal_pesanan') ?? date('Y-m-d') }}">
                            @error('tanggal_pesanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Banyak</th>
                                    <th>Harga</th>
                                    <th colspan="2">Jumlah</th>
                                </tr>
                            </thead>
                            <div style="max-height: 500px; overflow-y: scroll">
                                <tbody>
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach ($cartItems as $data)
                                        <tr class="border-bottom">
                                            <td>
                                                <div class="card my-3" style="width: 100px;">
                                                    @if ($data->attributes->image)
                                                        <img class="card-img-top" src="{{ asset('storage/'.$data->attributes->image) }}" alt="{{ $data->name }}" style="width: 100px; height: 100px">
                                                    @else
                                                        <img class="card-img-top" src="holder.js/100x100/?text=Gambar">
                                                    @endif
                                                    <div class="card-body p-0 px-2 py-2">
                                                        <p class="card-text" style="line-height: 1.5">{{ $data->name }}</p>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_menu[]" value="{{ $data->id }}">
                                            </td>
                                            <td><input class="form-control" type="text" name="banyak[]" value="{{ old('banyak.'.$i) ?? $data->quantity }}" style="width: 60px"></td>
                                            <td>
                                                Rp{{ $data->price }}
                                                <input type="hidden" name="harga[]" value="{{ $data->price }}">
                                            </td>
                                            <td>
                                                Rp<span class="jumlah">0</span>
                                                <input type="hidden" name="jumlah[]" value="0" readonly>
                                            </td>
                                            <td width="100">
                                                <a href="{{ route('pesanan.cart.remove', $data->id ) }}" class="remove-cart btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        <tr>
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </tbody>
                            </div>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Total</b></td>
                                    <td colspan="2">
                                        Rp<span id="total">0</span>
                                        <input type="hidden" name="total">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Tunai</b></td>
                                    <td colspan="2">
                                        <input class="form-control @error('tunai') is-invalid @enderror" type="text" name="tunai" style="width: 200px" value="{{ old('tunai') }}">
                                        @error('tunai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Kembali</b></td>
                                    <td colspan="2">
                                        Rp<span id="kembali">0</span>
                                        <input type="hidden" name="kembali">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    var form = document.querySelector('form');

    form.addEventListener('change', function(e) {
        calculate();
    });

    window.onload = function() {
        calculate();
    };

    function calculate() {
        var form = document.querySelector('form');
        var banyak = form["banyak[]"];
        var harga = form["harga[]"];
        var jumlah = form["jumlah[]"];
        var total = form["total"];
        var tunai = form["tunai"];
        var kembali = form["kembali"];
        var tmpJumlah = 0;
        var tmpTotal = 0;

        for (var i = 0; i < banyak.length; i++) {
            if (isNaN(banyak[i].value))
                banyak[i].value = 0;
            tmpJumlah = parseFloat(banyak[i].value) * parseFloat(harga[i].value);
            jumlah[i].value = tmpJumlah;
            document.getElementsByClassName("jumlah")[i].innerHTML = jumlah[i].value;
        }

        for (var i = 0; i < jumlah.length; i++)
            tmpTotal += parseFloat(jumlah[i].value);
        
        total.value = tmpTotal;
        document.getElementById("total").innerHTML = total.value;

        if (parseFloat(tunai.value) > 0)
            kembali.value = parseFloat(tunai.value) - parseFloat(total.value);
        else
            kembali.value = 0;
        document.getElementById("kembali").innerHTML = kembali.value;
    }
</script>
@endsection
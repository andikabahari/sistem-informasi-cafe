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
                            <tr>
                                <th>Banyak</th>
                                <th>Nama Menu</th>
                                <th width="300">Harga</th>
                                <th width="300">Jumlah</th>
                            </tr>
                            <tbody>
                                @php
                                    $i = 0
                                @endphp
                                @foreach ($menu as $data)
                                    <tr>
                                        <td><input class="form-control" type="text" name="banyak[]" value="{{ old('banyak.'.$i) ?? 0 }}" style="width: 60px"></td>
                                        <td>
                                            @if ($data->gambar)
                                                <img id="gambar" class="mt-3" src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->nama_menu }}" style="width: 80px; height: 80px">
                                            @else
                                                <img id="gambar" class="mt-3" src="holder.js/80x80/?text=Gambar">
                                            @endif
                                            <div>
                                                {{ $data->nama_menu }}
                                            </div>
                                            <input type="hidden" name="id_menu[]" value="{{ $data->id_menu }}">
                                        </td>
                                        <td>
                                            Rp{{ $data->harga }}
                                            <input type="hidden" name="harga[]" value="{{ $data->harga }}">
                                        </td>
                                        <td>
                                            Rp<span class="jumlah">0</span>
                                            <input type="hidden" name="jumlah[]" value="0" readonly>
                                        </td>
                                    <tr>
                                    @php
                                        $i++
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Total</b></td>
                                    <td>
                                        Rp<span id="total">0</span>
                                        <input type="hidden" name="total">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Tunai</b></td>
                                    <td>
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
                                    <td>
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
@extends('layouts.dashboard')

@section('title', 'Pilih Menu')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row mb-2" style="margin-top: 30px">
            <div class="col">
                <h2 class="section-title float-left" style="margin-top: 0px">Pesanan</h2>
                <a class="float-right" href="{{ route('pesanan.cart') }}"><i class="fa fa-shopping-cart mr-2"></i>Lihat keranjang</a>
            </div>
        </div>
        @include('partials.message')
        <div class="row">
            @foreach($menu as $data)
                <div class="col-sm-3">
                    <div class="card">
                        @if ($data->gambar)
                            <img class="card-img-top" src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->nama_menu }}" style="width: 100%; max-height: 200px">
                        @else
                            <img class="card-img-top" src="holder.js/150x150/?text=Gambar&auto=yes" style="width: 100%; max-height: 200px">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $data->nama_menu }}</h6>
                            <p class="card-text">Rp{{ $data->harga }}</p>
                        </div>
                        <div class="card-footer pt-0">
                            <form action="{{ route('pesanan.cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id_menu }}">
                                <input type="hidden" name="name" value="{{ $data->nama_menu }}">
                                <input type="hidden" name="price" value="{{ $data->harga }}">
                                <input type="hidden" name="image" value="{{ $data->gambar }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-shopping-cart mr-2"></i>Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
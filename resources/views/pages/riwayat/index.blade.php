@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row mb-4" style="margin-top: 30px">
            <div class="col-md-8">
                <h2 class="section-title" style="margin-top: 0px">Dashboard &mdash; {{ sprintf('%s, %s', date('M', strtotime($periode)), $tahun) }}</h2>
            </div>
            <div class="col-md-4">
                <form action="{{ route('riwayat') }}" method="get">
                    <div class="input-group mt-3 mt-md-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" name="periode" id="datepicker" placeholder="yyyy-mm" value="{{ $periode }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Lihat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/jqueryui/jquery-ui-1.12.1.min.css') }}">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
@endsection

@section('script')
<script src="{{ asset('plugins/jqueryui/jquery-ui-1.12.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
    });
</script>
@endsection
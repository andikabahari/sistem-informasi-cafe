@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row mb-2" style="margin-top: 30px">
            <div class="col-md-8">
                <h2 class="section-title" style="margin-top: 0px">Dashboard &mdash; {{ sprintf('%s, %s', date('M', strtotime($periode)), $tahun) }}</h2>
            </div>
            <div class="col-md-4">
                <form action="{{ route('dashboard') }}" method="get">
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
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Menu</h4>
                        </div>
                        <div class="card-body">{{ $jumlahMenu }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Pesanan</h4>
                        </div>
                        <div class="card-body">{{ $jumlahPesanan }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pendapatan</h4>
                        </div>
                        <div class="card-body">Rp{{ $totalPendapatan }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Grafik Pendapatan</h4>
            </div>
            <div class="card-body">
            <canvas id="myChart" style="max-height: 360px"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Tabel Pendapatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Pekan</th>
                                <th>Pesanan</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabelPendapatan as $data)
                                <tr>
                                    <td>{{ $data->periode }}</td>
                                    <td>Pekan ke-{{ $data->pekan }}</td>
                                    <td>{{ $data->pesanan }}</td>
                                    <td>Rp{{ $data->pendapatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($grafikPendapatan->pluck('pekan')->map(function ($value) {
                return 'Pekan ke-'.$value;
            })->toArray()) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($grafikPendapatan->pluck('pendapatan')->toArray()) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        }
    });
</script>
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
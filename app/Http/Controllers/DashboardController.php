<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Helpers\MyAuth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        MyAuth::authorize('pemilik');

        $jumlahMenu = Menu::count();

        $jumlahPesanan = DB::table('pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
                ->count('id_pesanan');

        $totalPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
                ->sum('tunai');

        $grafikPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
                ->groupBy(DB::raw('pekan'))
                ->select(DB::raw('
                    WEEK(tanggal_pesanan) as pekan,
                    SUM(tunai) as pendapatan
                '))
                ->get();

        $tabelPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
                ->groupBy(DB::raw('pekan'))
                ->select(DB::raw('
                    DATE_FORMAT(tanggal_pesanan, "%b, %Y") as periode,
                    WEEK(tanggal_pesanan) as pekan,
                    COUNT(pembayaran.id_pesanan) as pesanan,
                    SUM(tunai) as pendapatan
                '))
                ->get();

        return view('pages.dashboard.index', compact(
            'jumlahMenu',
            'jumlahPesanan',
            'totalPendapatan',
            'grafikPendapatan',
            'tabelPendapatan',
        ));
    }
}

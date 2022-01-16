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

        $strdate = $request->input('periode');
        if (preg_match('/\d{4}-\d{1,2}/', $strdate)) {
            $date = date_create($strdate);
            $tahun = date_format($date, 'Y');
            $bulan = date_format($date, 'm');
        } else {
            $tahun = date('Y');
            $bulan = date('m');
        }

        $periode = sprintf('%s-%s', $tahun, $bulan);

        $jumlahMenu = Menu::count();

        $jumlahPesanan = DB::table('pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $bulan)
                ->count('id_pesanan');

        $totalPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $bulan)
                ->sum('total');

        $grafikPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $bulan)
                ->groupBy(DB::raw('pekan'))
                ->select(DB::raw('
                    WEEK(tanggal_pesanan) as pekan,
                    SUM(total) as pendapatan
                '))
                ->get();

        $tabelPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $bulan)
                ->groupBy(DB::raw('pekan'))
                ->select(DB::raw('
                    DATE_FORMAT(tanggal_pesanan, "%b, %Y") as periode,
                    WEEK(tanggal_pesanan) as pekan,
                    COUNT(pembayaran.id_pesanan) as pesanan,
                    SUM(total) as pendapatan
                '))
                ->get();

        return view('pages.dashboard.index', compact(
            'jumlahMenu',
            'jumlahPesanan',
            'totalPendapatan',
            'grafikPendapatan',
            'tabelPendapatan',
            'periode',
            'tahun',
            'bulan',
        ));
    }
}

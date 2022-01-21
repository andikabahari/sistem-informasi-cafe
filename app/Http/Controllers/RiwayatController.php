<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyAuth;

class RiwayatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        MyAuth::authorize('kasir');

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

        $pesanan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $bulan)
                ->orderBy('pesanan.id_pesanan', 'desc')
                ->paginate(9);

        return view('pages.riwayat.index', compact(
            'pesanan',
            'periode',
            'tahun',
            'bulan',
        )); 
    }
}

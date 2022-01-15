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
                ->select(DB::raw('COUNT(id_pesanan) as jumlah_pesanan'))
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
                ->count();
        // $pendapatan = DB::table('pesanan')
        //         ->join(DB::raw('pembayaran', 'pembayaran.id_pembayaran', '=', 'pesanan.id_pesanan'))
        //         ->select(DB::raw('SUM(tunai) as pendapatan'))
        //         ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  date('Y'))
        //         ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  date('m'))
        //         ->get();
        
        //         dd($pendapatan);

        return view('pages.dashboard.index', compact(
            'jumlahMenu',
            'jumlahPesanan',
            // 'pendapatan',
        ));
    }
}

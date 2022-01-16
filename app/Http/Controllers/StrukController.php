<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Helpers\MyAuth;

class StrukController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        MyAuth::authorize('kasir');

        $pesanan = Pesanan::where('id_pesanan', $id)->first();

        $detailPesanan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
                ->join('menu', 'detail_pesanan.id_menu', '=', 'menu.id_menu')
                ->where('pesanan.id_pesanan', $id)
                ->get();

        $pembayaran = Pembayaran::where('id_pesanan', $id)->first();

        return view('pages.struk.index', compact(
            'pesanan',
            'detailPesanan',
            'pembayaran',
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePesananRequest;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Helpers\MyAuth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyAuth::authorize('kasir');

        $menu = Menu::where('aktif', true)->get();

        return view('pages.pesanan.index', compact('menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat()
    {
        MyAuth::authorize('kasir');

        $pesanan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->get();

        return view('pages.pesanan.riwayat', compact('pesanan')); 
    }

    /**
     * Show details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function struk($id)
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

        return view('pages.pesanan.struk', compact(
            'pesanan',
            'detailPesanan',
            'pembayaran',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePesananRequest $request)
    {
        MyAuth::authorize('kasir');

        $validated = $request->validated();

        $pesanan = Pesanan::create([
            'id_pengguna' => $validated['id_pengguna'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'tanggal_pesanan' => $validated['tanggal_pesanan'],
        ]);

        $idMenu = $request->input('id_menu');
        $banyak = $request->input('banyak');

        $menu = Menu::all();

        foreach ($menu as $row) {
            $index = array_search($row->id_menu, $idMenu);
            
            if ($index === false) continue;
            if ($row->id_menu != $idMenu[$index]) continue;
            if ($banyak[$index] < 1) continue;

            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_menu' => $row->id_menu,
                'banyak' => $banyak[$index]
            ]);
        }

        Pembayaran::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_pengguna' => $validated['id_pengguna'],
            'total' => $validated['total'],
            'tunai' => $validated['tunai'],
            'kembali' => $validated['kembali'],
        ]);

        $request->session()->flash('success_message', 'Pesanan berhasil disimpan!');

        return redirect()->route('pesanan');
    }
}

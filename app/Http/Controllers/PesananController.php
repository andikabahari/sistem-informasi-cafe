<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $menu = Menu::all();

        return view('pages.pesanan.index', compact('menu'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\DetailPesanan;
use App\Models\Pengguna;
use App\Helpers\MyAuth;

class MenuController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyAuth::authorize('pemilik');

        $menu = Menu::all();

        return view('pages.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyAuth::authorize('pemilik');

        return view('pages.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        MyAuth::authorize('pemilik');

        $validated = $request->validated();

        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('uploads');
        }

        Menu::create($validated);

        $request->session()->flash('success_message', 'Menu berhasil disimpan!');

        return redirect()->route('menu');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        MyAuth::authorize('pemilik');

        $menu = Menu::findOrFail($id);

        return view('pages.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, $id)
    {
        MyAuth::authorize('pemilik');
        
        $validated = $request->validated();

        if ($request->file('gambar')) {
            if ($request->input('old_gambar')) {
                Storage::delete($request->input('old_gambar'));
            }
            
            $validated['gambar'] = $request->file('gambar')->store('uploads');
        }

        Menu::where('id_menu', $id)->update($validated);

        $request->session()->flash('success_message', 'Menu berhasil disimpan!');

        return redirect()->route('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MyAuth::authorize('pemilik');

        if (DetailPesanan::where('id_menu', $id)->doesntExist()) {
            $menu = Menu::findOrFail($id);

            if ($menu->gambar) {
                Storage::delete($menu->gambar);
            }

            $menu->delete();
        }

        // $request->session()->flash('success_message', 'Menu berhasil dihapus!');

        return redirect()->route('menu');
    }
}

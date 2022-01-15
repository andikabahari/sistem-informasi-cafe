<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
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

        Menu::create([
            'id_pengguna' => $validated['id_pengguna'],
            'nama_menu' => $validated['nama_menu'],
            'harga' => $validated['harga'],
        ]);

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

        Menu::where('id_menu', $id)->update([
            'id_pengguna' => $validated['id_pengguna'],
            'nama_menu' => $validated['nama_menu'],
            'harga' => $validated['harga'],
        ]);

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

        Menu::findOrFail($id)->delete();

        // $request->session()->flash('success_message', 'Menu berhasil dihapus!');

        return redirect()->route('menu');
    }
}

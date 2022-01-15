<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\Pengguna;
use App\Helpers\MyAuth;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyAuth::authorize('pemilik');

        $pengguna = Pengguna::all();

        return view('pages.pengguna.index',compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyAuth::authorize('pemilik');

        return view('pages.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenggunaRequest $request)
    {
        MyAuth::authorize('pemilik');

        $validated = $request->validated();

        Pengguna::create([
            'nama_pengguna' => $validated['nama_pengguna'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'jabatan' => $validated['jabatan'],
        ]);

        $request->session()->flash('success_message', 'Menu berhasil disimpan!');

        return redirect()->route('pengguna');
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

        $pengguna = Pengguna::findOrFail($id);

        return view('pages.pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        MyAuth::authorize('pemilik');
        
        $validated = $request->validated();

        Pengguna::where('id_pengguna', $id)->update([
            'nama_pengguna' => $validated['nama_pengguna'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'jabatan' => $validated['jabatan'],
        ]);

        $request->session()->flash('success_message', 'Pengguna berhasil disimpan!');

        return redirect()->route('pengguna');
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

        Pengguna::findOrFail($id)->delete();

        // $request->session()->flash('success_message', 'Pengguna berhasil dihapus!');

        return redirect()->route('pengguna');
    }
}

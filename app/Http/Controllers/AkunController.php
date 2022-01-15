<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\MyAuth;
use App\Http\Requests\UpdateAkunRequest;
use App\Models\Pengguna;


class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = MyAuth::data();

        return view('pages.akun.index',compact('akun'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAkunRequest $request)
    {
        $id = MyAuth::id();
        $validated = $request->validated();

        Pengguna::where('id_pengguna', $id)->update([
            'nama_pengguna' => $validated['nama_pengguna'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'jabatan' => $validated['jabatan'],
        ]);

        $request->session()->flash('success_message', 'Akun berhasil disimpan!');

        return redirect()->route('akun');
    }
}

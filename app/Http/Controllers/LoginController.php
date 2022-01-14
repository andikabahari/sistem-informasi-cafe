<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\MyAuth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (MyAuth::login($username, $password)) {
            $request->session()->flash('success_message', 'Login telah berhasil.');

            return MyAuth::role('pemilik')
                    ? redirect()->route('dashboard')
                    : redirect()->route('pesanan');
        } else {
            $request->session()->flash('error_message', 'Username atau password yang Anda masukkan salah.');
            
            return redirect()->route('auth');
        }
    }
}

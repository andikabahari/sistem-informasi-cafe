<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MyAuth;
use App\Models\Pengguna;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('pages.auth.reset_password');
    }

    public function send(Request $request)
    {
        $email = $request->input('email');
        $pengguna = Pengguna::where('email', $email)->orWhere('username', $email)->first();

        if ($pengguna) {
            $html = '<p>Halo <b>%s</b>, password anda berhasil direset.</p>';
            $html .= '<p>Gunakan password berikut ini untuk login.</p>';
            $html .= '<p><b>%s</b></p>';

            $password = Str::random(16);

            $pengguna->password = MyAuth::hash($password);
            $pengguna->save();

            $body = sprintf($html, $pengguna->username, $password);
    
            \Mail::to($pengguna->email)->send(new \App\Mail\ResetPasswordMail($body));

            session()->flash('success_message', 'Password berhasil direset, silakan cek email anda.');
        } else {
            session()->flash('error_message', 'Email atau username yang anda masukkan tidak ditemukan.');
        }
        
        return redirect()->route('reset-password');
    }
}

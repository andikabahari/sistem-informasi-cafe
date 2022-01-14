<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\MyAuth;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (MyAuth::check()) {
            return MyAuth::role('pemilik')
                    ? redirect()->route('dashboard')
                    : redirect()->route('pesanan');
        }

        return view('pages.auth.index');
    }
}

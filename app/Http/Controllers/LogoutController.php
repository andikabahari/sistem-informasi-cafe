<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\MyAuth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        MyAuth::logout();

        return redirect()->route('auth');
    }
}

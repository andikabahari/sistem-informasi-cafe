<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', AuthController::class)->name('auth')->middleware('myauth.guest');

Route::post('/login', LoginController::class)->name('login');

Route::get('/logout', LogoutController::class)->name('logout');

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('myauth.user');



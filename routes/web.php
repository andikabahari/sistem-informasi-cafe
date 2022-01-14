<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AkunController;

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

Route::get('/', AuthController::class)->name('auth');

Route::post('/login', LoginController::class)->name('login');

Route::get('/logout', LogoutController::class)->name('logout');

Route::middleware('myauth')->group(function ()
{
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/edit', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/update', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/delete', [PesananController::class, 'destroy'])->name('pesanan.delete');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/update', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/delete', [MenuController::class, 'destroy'])->name('menu.delete');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/store', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/update', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/delete', [PenggunaController::class, 'destroy'])->name('pengguna.delete');

    Route::get('/akun', [MenuController::class, 'index'])->name('akun');
    Route::put('/akun/update', [MenuController::class, 'update'])->name('akun.update');
});
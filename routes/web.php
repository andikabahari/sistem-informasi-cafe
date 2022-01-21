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
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LaporanController;

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

Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class, 'send'])->name('reset-password.send');
// Route::get('/reset-password/new', [ResetPasswordController::class, 'newPassword'])->name('reset-password.new');
// Route::post('/reset-password/new', [ResetPasswordController::class, 'store'])->name('reset-password.store');

Route::get('/logout', LogoutController::class)->name('logout');

Route::middleware('myauth')->group(function ()
{
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    
    Route::get('/laporan/pesanan', [LaporanController::class, 'pesanan'])->name('laporan.pesanan');
    Route::get('/laporan/pendapatan', [LaporanController::class, 'pendapatan'])->name('laporan.pendapatan');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.delete');
    
    Route::get('/pesanan/cart', [PesananController::class, 'cartList'])->name('pesanan.cart');
    Route::post('/pesanan/cart', [PesananController::class, 'addToCart'])->name('pesanan.cart.store');
    Route::get('/pesanan/cart/{id}', [PesananController::class, 'removeCart'])->name('pesanan.cart.remove');

    Route::get('/riwayat', RiwayatController::class)->name('riwayat');

    Route::get('/struk/{id}', StrukController::class)->name('struk');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.delete');

    Route::get('/akun', [AkunController::class, 'index'])->name('akun');
    Route::post('/akun', [AkunController::class, 'update'])->name('akun.update');
});
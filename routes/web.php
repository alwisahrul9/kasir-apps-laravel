<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Untuk yang sudah login
Route::middleware('auth')->group(function () {
    // Pages
    Route::get('/', [PagesController::class, 'index'])->name('dashboard');
    Route::get('/entri-order', [PagesController::class, 'entriOrder'])->name('entriOrder');
    Route::get('/transaksi-aktif', [PagesController::class, 'transaksiAktif'])->name('transaksiAktif');
    Route::get('/riwayat-transaksi', [PagesController::class, 'riwayatTransaksi'])->name('riwayatTransaksi');
    Route::get('/generate-laporan', [PagesController::class, 'generateLaporan'])->name('generateLaporan');
    
    // Method
    Route::post('/store-makanan', [MenuController::class, 'store']);
    Route::post('/update-makanan/{id}', [MenuController::class, 'update']);
    Route::get('/hapus-makanan/{id}', [MenuController::class, 'destroy']);
    Route::post('/order-makanan', [OrderController::class, 'store']);
    Route::get('/hapus-order/{id}', [OrderController::class, 'destroy']);
    Route::post('/transaksi-orderan/{id}', [OrderController::class, 'update']);
    Route::get('/print-transaksi/{id}', [OrderController::class, 'printTransaksi']);
    Route::get('/print-laporan', [OrderController::class, 'printLaporan']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Untuk yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [PagesController::class, 'loginPage'])->name('login');
    Route::post('/login-process', [AuthController::class, 'loginProcess']);
});
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanMitraController;
use App\Http\Controllers\KategoriBahanController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ObrolanController;
use App\Http\Controllers\PengadaanBahanController;
use App\Http\Controllers\PenjualanProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StokBahanController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'getAll']);
    Route::get('/{produk}', [ProdukController::class, 'findOne']);
    Route::post('/', [ProdukController::class, 'add'])->middleware(['auth:sanctum', 'karyawan']);
    Route::put('/{id}', [ProdukController::class, 'update'])->middleware(['auth:sanctum', 'karyawan']);
    Route::delete('/{id}', [ProdukController::class, 'delete'])->middleware(['auth:sanctum', 'karyawan']);
});

Route::prefix('kategori-produk')->group(function () {
    Route::get('/', [KategoriProdukController::class, 'getAll']);
    Route::get('/{kategoriProduk}', [KategoriProdukController::class, 'findOne']);
    Route::post('/', [KategoriProdukController::class, 'add'])->middleware(['auth:sanctum', 'karyawan']);
    Route::put('/{id}', [KategoriProdukController::class, 'update'])->middleware(['auth:sanctum', 'karyawan']);
    Route::delete('/{id}', [KategoriProdukController::class, 'delete'])->middleware(['auth:sanctum', 'karyawan']);
});

Route::prefix('kategori-bahan')->group(function () {
    Route::get('/', [KategoriBahanController::class, 'getAll']);
    Route::get('/{kategoriBahan}', [KategoriBahanController::class, 'findOne']);
    Route::post('/', [KategoriBahanController::class, 'add'])->middleware(['auth:sanctum', 'karyawan']);
    Route::put('/{id}', [KategoriBahanController::class, 'update'])->middleware(['auth:sanctum', 'karyawan']);
    Route::delete('/{id}', [KategoriBahanController::class, 'delete'])->middleware(['auth:sanctum', 'karyawan']);
});

Route::prefix('bahan-mitra')->group(function () {
    Route::get('/', [BahanMitraController::class, 'getAll']);
    Route::get('/{bahanMitra}', [BahanMitraController::class, 'findOne']);
    Route::post('/', [BahanMitraController::class, 'add'])->middleware(['auth:sanctum', 'mitra']);
    Route::put('/{id}', [BahanMitraController::class, 'update'])->middleware(['auth:sanctum', 'mitra']);
    Route::delete('/{id}', [BahanMitraController::class, 'delete'])->middleware(['auth:sanctum', 'mitra']);
});

Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'getAll']);
    Route::get('/{role}', [RoleController::class, 'findOne']);
    Route::post('/', [RoleController::class, 'add']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'delete']);
});

Route::prefix('stok-bahan')->middleware(['auth:sanctum', 'karyawan'])->group(function () {
    Route::get('/', [StokBahanController::class, 'getAll']);
    Route::get('/{stokBahan}', [StokBahanController::class, 'findOne']);
    Route::post('/', [StokBahanController::class, 'add']);
    Route::put('/{id}', [StokBahanController::class, 'update']);
    Route::delete('/{id}', [StokBahanController::class, 'delete']);
});

Route::prefix('pengadaan-bahan')->middleware(['auth:sanctum', 'notcustomer'])->group(function () {
    Route::get('/{pengadaanBahan}', [PengadaanBahanController::class, 'findOne']);
    Route::post('/', [PengadaanBahanController::class, 'add']);
    Route::put('/{id}', [PengadaanBahanController::class, 'update']);
    Route::delete('/{id}', [PengadaanBahanController::class, 'delete']);
});

Route::prefix('penjualan-produk')->middleware(['auth:sanctum', 'notmitra'])->group(function () {
    Route::get('/{penjualanProduk}', [PenjualanProdukController::class, 'findOne']);
    Route::post('/', [PenjualanProdukController::class, 'add']);
    Route::put('/{id}', [PenjualanProdukController::class, 'update']);
    Route::delete('/{id}', [PenjualanProdukController::class, 'delete']);
});

Route::prefix('chat')->middleware(['auth:sanctum', 'notmitra'])->group(function () {
    Route::get('/', [ObrolanController::class, 'getAllChat']);
    Route::get('/{idChatRoom}', [ObrolanController::class, 'chatRoom'])->middleware(['myChat']);
    Route::post('/{idReceiverUser}', [ObrolanController::class, 'send']);
    Route::delete('/pesan/{idObrolan}', [ObrolanController::class, 'deleteMessage']);
    Route::delete('/{idChat}', [ObrolanController::class, 'deleteChat']);
});

Route::prefix('report')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/pembelian/pelanggan', [PenjualanProdukController::class, 'reportPembelianPelanggan'])->middleware('pelanggan');
    Route::get('/penjualan/perusahaan', [PenjualanProdukController::class, 'reportpenjualanPerusahaan'])->middleware('karyawan');
    Route::get('/pembelian/perusahaan', [PengadaanBahanController::class, 'reportPembelianPerusahaan'])->middleware('karyawan');
    Route::get('/penjualan/mitra', [PengadaanBahanController::class, 'reportPenjualanMitra'])->middleware('mitra');
});

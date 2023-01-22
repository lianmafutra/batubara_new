<?php

use App\Http\Controllers\Harga\HargaController;
use App\Http\Controllers\Harga\HargaPengaturanController;
use App\Http\Controllers\Kendaraan\MobilController;
use App\Http\Controllers\Kendaraan\PemilikController;
use App\Http\Controllers\Kendaraan\SupirController;
use App\Http\Controllers\Transaksi\PembayaranController;
use App\Http\Controllers\Transaksi\PencairanController;
use App\Http\Controllers\Transaksi\SetoranController;
use App\Http\Controllers\Transaksi\UangJalanController;
use App\Http\Controllers\Transportir\TransportirController;
use App\Http\Controllers\Tujuan\TujuanController;
use App\Models\HargaPengaturan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {

   Route::prefix('kendaraan')->group(function () {
      Route::resource('mobil', MobilController::class);
      Route::resource('pemilik', PemilikController::class);
      Route::resource('supir', SupirController::class);
   });

   
   Route::controller(SetoranController::class)->group(function () {
      Route::resource('setoran', SetoranController::class);
      Route::post('master-harga', 'getMasterHarga')->name('master.harga');
   });


   Route::prefix('pembayaran')->name('pembayaran.')->controller(PembayaranController::class)->group(function () {
      Route::get('/', 'index')->name('index');
      Route::post('bayar', 'bayar')->name('bayar');
   });


   Route::resource('pencairan', PencairanController::class);
   Route::resource('uang-jalan', UangJalanController::class);
   Route::resource('transportir', TransportirController::class);

   Route::controller(HargaController::class)->group(function () {
      Route::resource('harga', HargaController::class);
      Route::resource('pengaturan_harga', HargaPengaturanController::class);
      Route::post('destroyMulti', 'destroyMulti')->name('destroy.multi');
   });
  

   Route::resource('tujuan', TujuanController::class);
  

   
});





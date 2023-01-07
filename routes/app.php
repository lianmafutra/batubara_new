<?php

use App\Http\Controllers\Harga\HargaController;
use App\Http\Controllers\Kendaraan\MobilController;
use App\Http\Controllers\Kendaraan\PemilikController;
use App\Http\Controllers\Kendaraan\SupirController;
use App\Http\Controllers\Transportir\TransportirController;
use App\Http\Controllers\Tujuan\TujuanController;
use App\Models\Pembayaran;
use App\Models\Pencairan;
use App\Models\Setoran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {

   Route::prefix('kendaraan')->group(function () {
      Route::resource('mobil', MobilController::class);
      Route::resource('pemilik', PemilikController::class);
      Route::resource('supir', SupirController::class);
   });

   Route::prefix('transaksi')->group(function () {
      Route::resource('setoran', Setoran::class);
      Route::resource('pencairan', Pencairan::class);
      Route::resource('pembayaran', Pembayaran::class);
   });
 
   Route::resource('transportir', TransportirController::class);
   Route::resource('harga', HargaController::class);
   Route::resource('tujuan', TujuanController::class);
  

   
});





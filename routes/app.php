<?php

use App\Http\Controllers\Harga\HargaController;
use App\Http\Controllers\Harga\HargaPengaturanController;
use App\Http\Controllers\Kendaraan\MobilController;
use App\Http\Controllers\Kendaraan\PemilikController;
use App\Http\Controllers\Kendaraan\SupirController;
use App\Http\Controllers\Transaksi\KasbonController;
use App\Http\Controllers\Transaksi\PembayaranController;
use App\Http\Controllers\Transaksi\PembayaranHistoriController;
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
      Route::post('bayar-preview', 'bayarPreview')->name('bayar.preview');
      Route::post('bayar-histori', 'bayarHistori')->name('bayar.histori');
   });

   Route::prefix('pembayaran/histori')->name('pembayaran.histori.')->controller(PembayaranHistoriController::class)->group(function () {
      Route::get('/', 'index')->name('index');
      Route::delete('hapus/{id}', 'destroy')->name('destroy');
      Route::get('print/{histori_pembayaran_id}', 'print')->name('print');
   });

   
   Route::prefix('pencairan')->name('pencairan.')->controller(PencairanController::class)->group(function () {
      Route::get('/', 'index')->name('index');
      Route::post('pencairan-preview', 'pencairanPreview')->name('preview');
      Route::post('pencairan-histori', 'pencairanHistori')->name('histori');
   });

   Route::prefix('pencairan/histori')->name('pencairan.histori.')->controller(PencairanController::class)->group(function () {
      Route::get('/', 'index')->name('index');
      Route::delete('hapus/{id}', 'destroy')->name('destroy');
      Route::get('print/{histori_pencairan_id}', 'print')->name('print');
   });


   Route::resource('uang-jalan', UangJalanController::class);
   Route::resource('transportir', TransportirController::class);

   Route::controller(HargaController::class)->group(function () {
      Route::resource('harga', HargaController::class);
      Route::post('destroyMulti', 'destroyMulti')->name('destroy.multi');
   });

   Route::resource('pengaturan_harga', HargaPengaturanController::class);
   Route::controller(HargaPengaturanController::class)->name('pengaturan_harga.')->group(function () {
      Route::get('harga_pencairan/{id}', 'edit_harga_pencairan')->name('pencairan');
      Route::post('harga_pencairan', 'update_harga_pencairan')->name('pencairan.update');
      Route::post('harga_pembayaran', 'update_harga_pembayaran')->name('pembayaran.update');
   });
  
  
   Route::resource('tujuan', TujuanController::class);
   Route::resource('kasbon', KasbonController::class);
   
});





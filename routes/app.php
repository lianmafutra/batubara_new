<?php

use App\Http\Controllers\Harga\HargaController;
use App\Http\Controllers\Kendaraan\MobilController;
use App\Http\Controllers\Kendaraan\SupirController;
use App\Http\Controllers\Transportir\TransportirController;
use App\Http\Controllers\Tujuan\TujuanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::prefix('admin')->middleware(['auth'])->group(function () {

   Route::resource('mobil', MobilController::class)->except(['show','create']);
   Route::resource('supir', SupirController::class);
   Route::resource('transportir', TransportirController::class);
   Route::resource('harga', HargaController::class);
   Route::resource('tujuan', TujuanController::class);
});


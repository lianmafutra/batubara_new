<?php

namespace App\Http\Controllers\Harga;

use App\Http\Controllers\Controller;
use App\Models\HargaPengaturan;
use Illuminate\Http\Request;

class HargaPengaturanController extends Controller
{


   public function update(Request $request)
   {

      try {
         HargaPengaturan::where('id', 1)->update([
            'hrg_pembayaran' => $request->hrg_pembayaran,
            'hrg_pencairan'  => $request->hrg_pencairan
         ]);
        return $this->success('Berhasil Mengubah Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }


   public function edit()
   {
      return $this->success('Pengaturan Data Harga', HargaPengaturan::find(1));
   }
}

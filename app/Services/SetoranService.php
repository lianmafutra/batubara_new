<?php

namespace App\Services;

use App\Models\Harga;
use Carbon\Carbon;

trait SetoranService
{
   protected $tgl_muat;



   public function getHarga($tgl_muat, $tujuan_id)
   {
      // get harga pembayaran sesuai tgl muat dan tujuan id
      // harga ambil dari harga pembayaran (harga asli -2)
      $data = null;
      $tgl_muat = Carbon::parse( $tgl_muat)->translatedFormat('Y-m-d');
      $tgl_awal =  Harga::with('tujuan','transportir')
      ->where('tujuan_id', $tujuan_id)
      ->orderBy('tanggal', 'asc')->first();

      if($tgl_awal){
         if ($tgl_muat <= $tgl_awal->tanggal) {
            $data = $tgl_awal;
         } else {
            $data = Harga::with('tujuan','transportir')
            ->where('tujuan_id', $tujuan_id)
            ->where('tanggal', '<=', $tgl_muat)
            ->orderBy('tanggal', 'desc')->first();
         }
         return $data->harga_pembayaran;
      }

   }

   public function hitungKotor($berat, $harga, $pijak_gas){
      // rumus = (berat * harga) + PG (Pijak Gas)
      return ($berat*$harga) + $pijak_gas;
   }

   public function hitungBersih($total_kotor, $uang_jalan){
        // rumus = total kotor - (total uang jalan + uang lainnya)
        return $total_kotor-$uang_jalan;
   }
}

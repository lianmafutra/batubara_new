<?php

namespace App\Services;

use App\Models\Harga;
use Carbon\Carbon;

trait SetoranService
{
   protected $tgl_muat;

   public function hitungHargaByTglMuat($tgl_muat)
   {
      $harga = 0;
      $tgl_muat = Carbon::parse( $tgl_muat)->translatedFormat('Y-m-d');
      $tgl_awal =  Harga::orderBy('tanggal', 'asc')->first();

      if ($tgl_muat <= $tgl_awal->tanggal) {
         $harga = $tgl_awal->harga;
      } else {
         $harga = Harga::where('tanggal', '<=', $tgl_muat)->orderBy('tanggal', 'desc')->first()->harga;
      }
      return $harga;
   }

   public function getMasterHargaByTglMuat($tgl_muat)
   {
      $data = null;
      $tgl_muat = Carbon::parse( $tgl_muat)->translatedFormat('Y-m-d');
      $tgl_awal =  Harga::with('tujuan','transportir')->orderBy('tanggal', 'asc')->first();

      if ($tgl_muat <= $tgl_awal->tanggal) {
         $data = $tgl_awal;
      } else {
         $data = Harga::with('tujuan','transportir')->where('tanggal', '<=', $tgl_muat)->orderBy('tanggal', 'desc')->first();
      }
      return $data;
   }

   public function hitungTotalKotor($berat, $harga){
      // rumus = (berat * harga)+ ?
      return $berat*$harga;
   }

   public function hitungTotalBersih($total_kotor, $uang_jalan){
        // rumus = (total kotor - uang jalan)+ 
        return $total_kotor-$uang_jalan;
   }
}
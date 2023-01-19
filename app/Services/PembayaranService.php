<?php

namespace App\Services;

use App\Models\Setoran;

class PembayaranService
{

   use SetoranService;

   public function hitungTotalUangJalan($setoran_id_array)
   {
      return intval(Setoran::whereIn('id', $setoran_id_array)->sum('uang_jalan'));
   }

   public function hitungTotalUangJalanTambahan($setoran_id_array)
   {
      return intval(Setoran::whereIn('id', $setoran_id_array)->sum('uang_tambahan'));
   }

   public function hitungTotalPijakGas($setoran_id_array)
   {
      return intval(Setoran::whereIn('id', $setoran_id_array)->sum('pg'));
   }

   public function hitungTotalKotor($setoran_id_array)
   {
      $total_kotor=0;
      $setoran = Setoran::whereIn('id', $setoran_id_array)->get();
     
      foreach ($setoran as $key => $value) {
        $total_kotor += ($value->berat * $value->harga) + $value->pg;
      }
      return $total_kotor;
   }

   public function hitungTotalBersih($setoran_id_array)
   {
      $total_bersih=0;

      
      $setoran = Setoran::whereIn('id', $setoran_id_array)->get();
     
      foreach ($setoran as $value) {
        $total_bersih +=  (($value->berat * $value->harga) + $value->pg) - $value->uang_jalan ;

      return $total_bersih;
   }

  
   }
}

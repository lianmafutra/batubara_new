<?php

namespace App\Models;

use App\Services\SetoranService;
use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
   use SetoranService;
   use HasFactory;
   protected $table = 'setoran';
   protected $guarded = [];
   protected $appends  = ['harga', 'total_kotor', 'total_bersih'];


   protected $casts = [
      'created_at'           => 'date:d-m-Y H:m:s',
      'updated_at'           => 'date:d-m-Y H:m:s',
      'tgl_ambil_uang_jalan' => 'date:d-m-Y',
      'tgl_muat'             => 'date:d-m-Y',
   ];


   public function getHargaAttribute()
   {
       return $this->hitungHargaByTglMuat($this->attributes['tgl_muat']);  
   }

   public function getTotalKotorAttribute()
   {
       return $this->hitungTotalKotor($this->attributes['berat'],$this->getHargaAttribute());  
   }

   public function getTotalBersihAttribute()
   {
       return $this->hitungTotalBersih($this->getTotalKotorAttribute(),$this->attributes['uang_jalan']);  
   }

   public function supir()
   {
      return $this->hasOne(Supir::class, 'id', 'supir_id')->withDefault([
         'nama' => '',
      ]);
   }

   public function setTglAmbilUangJalanAttribute($value)
   {
      $this->attributes['tgl_ambil_uang_jalan'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function setUangJalanAttribute($value)
   {
      $this->attributes['uang_jalan'] = Rupiah::clean($value);
   }
}

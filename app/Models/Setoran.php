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

   // relation
   public function supir()
   {
      return $this->hasOne(Supir::class, 'id', 'supir_id');
   }

   // global setter format uang input kedatabase
   public function setAttribute($key, $value)
   {
      if (in_array($key, ['uang_jalan', 'uang_tambahan', 'uang_kurangan', 'pg'])) {
         $this->attributes[$key] = Rupiah::clean($value);
         return $this;
      }
      return parent::setAttribute($key, $value);
   }

   public function getHargaAttribute()
   {
      return $this->hitungHargaByTglMuat($this->attributes['tgl_muat']);
   }

   public function getTotalKotorAttribute()
   {
      return $this->hitungTotalKotor($this->attributes['berat'], $this->getHargaAttribute(), $this->attributes['pg'] );
   }

   public function getTotalBersihAttribute()
   {
      return $this->hitungTotalBersih($this->getTotalKotorAttribute(), $this->attributes['uang_jalan']);
   }


   public function setTglAmbilUangJalanAttribute($value)
   {
      $this->attributes['tgl_ambil_uang_jalan'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function setTglMuatAttribute($value)
   {
      $this->attributes['tgl_muat'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }
}

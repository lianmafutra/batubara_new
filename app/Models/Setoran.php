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
   protected $appends  = ['harga_bayar','total_uang_lainnya', 'total_kotor', 'total_bersih'];

   protected $casts = [
      'created_at'           => 'date:d-m-Y H:m:s',
      'updated_at'           => 'date:d-m-Y H:m:s',
      'tgl_ambil_uang_jalan' => 'date:d-m-Y',
      'tgl_muat'             => 'date:d-m-Y',
   ];

   // global setter format uang input kedatabase
   public function setAttribute($key, $value)
   {
      if (in_array($key, ['uang_jalan', 'uang_lainnya','pg','berat'])) {
         $this->attributes[$key] = Rupiah::clean($value);
         return $this;
      }
      return parent::setAttribute($key, $value);
   }

   // relation
   public function supir()
   {
      return $this->hasOne(Supir::class, 'id', 'supir_id');
   }

   public function getHargaBayarAttribute()
   {
      return $this->getHarga($this->attributes['tgl_muat'], $this->attributes['tujuan_id']);
   }

   public function getTotalKotorAttribute()
   {
      return $this->hitungKotor($this->attributes['berat'], $this->getHargaBayarAttribute(), $this->attributes['pg'] );
   }

   
   public function getTotalUangLainnyaAttribute()
   {
      return $this->attributes['uang_jalan']+$this->attributes['uang_lainnya'] ;
   }

   public function getTotalBersihAttribute()
   {
      return $this->hitungBersih($this->getTotalKotorAttribute(),  $this->attributes['uang_jalan']+$this->attributes['uang_lainnya']);
   }


   public function setTglAmbilUangJalanAttribute($value)
   {
      $this->attributes['tgl_ambil_uang_jalan'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function setTglMuatAttribute($value)
   {
      $this->attributes['tgl_muat'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function setTglBayarAttribute($value)
   {
      $this->attributes['tgl_bayar'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }
}

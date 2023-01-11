<?php

namespace App\Models;

use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
   use HasFactory;
   protected $table = 'setoran';
   protected $guarded = [];

   protected $casts = [
      'created_at'           => 'date:d-m-Y H:m:s',
      'updated_at'           => 'date:d-m-Y H:m:s',
      'tgl_ambil_uang_jalan' => 'date:d-m-Y',
   ];


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

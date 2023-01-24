<?php

namespace App\Models;

use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasbon extends Model
{
   use HasFactory;
   protected $table = 'kasbon';
   protected $guarded = [];


   protected $casts = [
      'created_at'     => 'date:d-m-Y H:m:s',
      'updated_at'     => 'date:d-m-Y H:m:s',
      'tanggal_kasbon' => 'date:d-m-Y',
   ];

   public function pemilik()
   {
      return $this->hasOne(Pemilik::class, 'id', 'pemilik_mobil_id');
   }
   public function mobil()
   {
      return $this->hasOne(Mobil::class, 'id', 'mobil_id');
   }

   public function setTanggalKasbonAttribute($value)
   {
      $this->attributes['tanggal_kasbon'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }
   public function setJumlahUangAttribute($value)
   {
      return $this->attributes['jumlah_uang'] = Rupiah::clean($value);
   }

  
}

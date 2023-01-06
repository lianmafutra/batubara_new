<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
   use HasFactory;
   use AutoUUID;

   protected $table = 'mobil';
   protected $guarded = [];

   protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
   ];
 
   public function pemilik()
   {
      return $this->hasOne(Pemilik::class, 'id', 'pemilik_mobil_id');
   }

   public function mobil_jenis()
   {
      return $this->hasOne(MobilJenis::class, 'id', 'mobil_jenis_id');
   }

   public function getId($uuid)
   {
      return $this->where('uuid', $uuid)->first()->id;
   }

   public function getJenis()
   {
      return ['BAK'];
   }

}

<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Mobil extends Model
{
   use HasFactory;
   use AutoUUID;

   protected $table = 'mobil';
   protected $guarded = [];
   // protected $appends = ['hash'];
   protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
   ];
   // protected $encryptable = ['id'];
   public function pemilik2()
   {
      return $this->hasOne(Pemilik::class, 'id', 'pemilik_mobil_id');
   }

   public function mobil_jenis2()
   {
      return $this->hasOne(MobilJenis::class, 'id', 'mobil_jenis_id');
   }

   // public function getId($uuid)
   // {
   //    return $this->where('uuid', $uuid)->first()->id;
   // }


   public function getJenis()
   {
      return ['BAK'];
   }


   // public function getIdAttribute($value)
   // {
   //    return Hashids::encode($value);
   // }

   // public function getIdAttribute($value)
   // {
   //    return Hashids::encode($value);
   // }

   
   // public function getPemilikMobilIdAttribute($value)
   // {
   //    return $this->attributes['pemilik_mobil_id'] =  Hashids::encode($value);
   // }

   // public function getMobilJenisIdAttribute($value)
   // {
   //    return Hashids::encode($value);
   // }
   
   // protected function hash(): Attribute
   // {
   //     return  Attribute::make(
   //         get: fn ($value) => Hashids::encode($this->id)
   //     );
   // }
   // public function resolveRouteBinding($value, $field = null)
   // {
   //     return $this->where('name', $value)->firstOrFail();
   // }
   
   protected function mobilJenisId(): Attribute
   {
       return  Attribute::make(
           get: fn ($value) => Hashids::encode($value)
       );
   }

   
   // protected function pemilikMobilId(): Attribute
   // {
   //     return  Attribute::make(
   //         get: fn ($value) => Hashids::encode($value)
   //     );
   // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class MobilJenis extends Model
{
    use HasFactory;
    protected $table = 'mobil_jenis';
    protected $guarded = [];

    
    protected $casts = [
      'created_at'       => 'date:d-m-Y H:m:s',
   ];

   protected function id(): Attribute
   {
       return  Attribute::make(
           get: fn ($value) => Hashids::encode($value)
       );
   }
   // protected function hash(): Attribute
   // {
   //     return  Attribute::make(
   //         get: fn ($value) => Hashids::encode($this->id)
   //     );
   // }

}

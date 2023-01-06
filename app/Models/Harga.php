<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    use AutoUUID;
    protected $table = 'harga';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
   ];

   public function tujuan()
   {
      return $this->belongsTo(Tujuan::class);
   }

   public function transportir()
   {
      return $this->belongsTo(Transportir::class);
   }
 
}

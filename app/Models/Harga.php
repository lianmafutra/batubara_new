<?php

namespace App\Models;

use App\Utils\AutoUUID;
use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
   //  use AutoUUID;
    protected $table = 'harga';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
      'tanggal'     => 'date:d-m-Y'
   ];

   public function tujuan()
   {
      return $this->belongsTo(Tujuan::class);
   }

   public function transportir()
   {
      return $this->belongsTo(Transportir::class);
   }

   public function setHargaAttribute($value) {
       $this->attributes['harga'] = Rupiah::clean($value);
   }

   public function setPgAttribute($value) {
       $this->attributes['pg'] = Rupiah::clean($value);
   }

   public function setTanggalAttribute($value) {
       $this->attributes['tanggal'] =  Carbon::parse( $value)->translatedFormat('Y-m-d');
   }

//    public function getTanggalAttribute() {
//       return  Carbon::parse( $this->tanggal)->translatedFormat('d-m-Y');
//   }
 
}

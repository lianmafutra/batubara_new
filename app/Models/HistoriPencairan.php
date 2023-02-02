<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriPencairan extends Model
{
    use HasFactory;
    protected $table = 'histori_pencairan';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
      'tgl_pencairan'  => 'date:d-m-Y',
   ];

   public function setTglPencairanAttribute($value)
   {
      $this->attributes['tgl_pencairan'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function getLastId(){
      $last_id = $this->latest()->first() ? $this->latest()->first()->id+1 : 1;
      return $last_id;
      
   }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriPembayaran extends Model
{
    use HasFactory;
    protected $table = 'histori_pembayaran';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
      'tgl_bayar'  => 'date:d-m-Y ',
   ];


   public function getLastId(){
      $last_id = $this->latest()->first() ? $this->latest()->first()->id+1 : 1;
      return $last_id;
      
   }
}

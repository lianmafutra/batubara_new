<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilJenis extends Model
{
    use HasFactory;
    protected $table = 'mobil_jenis';
    protected $guarded = [];

    
    protected $casts = [
      'created_at'       => 'date:d-m-Y H:m:s',
   ];

 
}

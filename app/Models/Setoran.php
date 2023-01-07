<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;
    protected $table = 'setoran';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
   ];

   

}

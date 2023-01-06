<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory;
    use AutoUUID;
    protected $table = 'tujuan';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
   ];
}

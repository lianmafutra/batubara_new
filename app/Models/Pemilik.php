<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    use AutoUUID;
    protected $table = 'pemilik_mobil';
    protected $guarded = [];

    public function getId($uuid){
      return $this->where('uuid', $uuid)->first()->id;
    }

}

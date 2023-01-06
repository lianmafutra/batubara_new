<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Pemilik extends Model
{
    use HasFactory;
    use AutoUUID;
    protected $table = 'pemilik_mobil';
    protected $guarded = [];

    protected $casts = [
      'created_at'       => 'date:d-m-Y H:m:s',
   ];

    public function getRolesOriginAttribute() {
        return $this->relations['permissions']->pluck('name');
   }



}

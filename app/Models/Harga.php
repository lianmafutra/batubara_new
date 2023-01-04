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
}

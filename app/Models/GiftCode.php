<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCode extends Model
{
    use HasFactory;
    protected $table = 'gift_codes';
    protected $guarded = [];
}

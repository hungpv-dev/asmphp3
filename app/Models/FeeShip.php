<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    use HasFactory;
    protected $table = 'feeships';
    public $fillable = [
        'province',
        'district',
        'ward',
        'price'
    ];
    public $timestamps = false;
}

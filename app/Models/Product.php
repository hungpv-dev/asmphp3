<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'price',
        'price_seal',
        'desc_short',
        'desc',
        'buy',
        'status',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }

    public function properties(){
        return $this->hasMany(Property::class,'product_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}

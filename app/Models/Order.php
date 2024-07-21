<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userImage(){
        if ($this->user && $this->user->image) {
            return $this->user->image->url;
        }
        return 'https://tse4.explicit.bing.net/th?id=OIP.xo-BCC1ZKFpLL65D93eHcgHaGe&pid=Api&P=0&h=220';
    }

    public function products(){
        return $this->hasMany(OrderCart::class,'order_id','id');
    }

    public function vnpay(){
        return $this->hasOne(VnPay::class,'bill_id','id');
    }

    public function gift(){
        return $this->hasOne(GiftCode::class,'id','gift_code');
    }

    public function trangThai(){
        return $this->hasOne(OrderStatus::class,'id','status');
    }

}

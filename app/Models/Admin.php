<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    public $fillable = [
        'name',
        'email',
        'password',
    ];

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function profile(){
        return $this->morphOne(Profile::class,'userable');
    }
}

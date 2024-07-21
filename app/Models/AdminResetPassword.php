<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminResetPassword extends Model
{
    use HasFactory;
    protected $table = 'password_admin_reset_tokens';
    protected $primaryKey = 'email';
    public $fillable = [
        'email',
        'token',
        'created_at'
    ];
    public $timestamps  = false;
}

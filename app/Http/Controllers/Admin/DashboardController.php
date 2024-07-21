<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Trang quản trị';
        return view('admin.dashboard.admin',compact('title'));
    }

    public function user(){
        $title = 'Trang quản trị';
        return view('admin.dashboard.user',compact('title'));
    }
}

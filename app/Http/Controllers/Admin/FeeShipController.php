<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeeShipController extends Controller
{
    public function index(){
        $title = 'Phí vận chuyển';
        return view('admin.feeship.index',compact('title'));
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailReQuest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function showFormLogin(){
        $title = 'Đăng nhập Admin';
        return view('admin.auth.login',compact('title'));
    }

    public function login(EmailReQuest $request){
        
        $request->flash();

        $login = $request->only('email','password');

        if(Auth::guard('admin')->attempt($login,$request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect(route('admin.home'));
        }
        Alert::error('Thông báo','Tài khoản hoặc mật khẩu không chính xác!');
        return redirect(route('admin.login'));
    }

    public function register($tk,$mk){
        Admin::create([
            'name' => 'Phạm Hùng',
            'email' => $tk,
            'password' => Hash::make($mk),
        ]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return back();
    }
}

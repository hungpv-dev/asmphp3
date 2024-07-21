<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HtmlString;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    function showFormLogin(){
        $title = 'Đăng nhập';
        return view('auth.login',compact('title'));
    }

    public function login(Request $request){
        $validator = $this->validateLogin($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $user = User::where('email',$request->email)->whereNull('google_id')->where('facebook_id')->whereNull('twitter_id')->first();
        if($user){
            if($user->email_verified_at == NULL){
                Alert::html('Thông báo', 'Tài khoản này chưa được xác thực, Vui lòng xác thực <a class="text-primary" href="'.route('verify.show').'">tại đây</a>', 'info');
                return redirect(route('login'));
            }
            Auth::login($user,$request->boolean('remember'));
            return redirect(route('home'));
        }
        Alert::error('Thông báo','Đăng nhập thất bại, tài khoản hoặc mật khẩu sai');
        return redirect(route('login'));
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function validateLogin($request){
        $roles = [
            'email' => ['required','email'],
            'password' => ['required','min:8','max:20'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc nhập',
            'email' => ':attribute không hợp lệ',
            'min' => ':attribute tối thiểu :min kí tự',
            'max' => ':attribute tối đa :max kí tự',
        ];
        $attributes = [
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];

        $validate = Validator::make($request->all(),$roles,$messages,$attributes);

        return $validate;
    }

    public function rememberToken(Request $request){
        if($request->user()){
            Auth::login($request->user(), true);
            return response()->json([
                'code' => 200,
                'message' => 'remember success'
            ]);
        }
        return response()->json([
            'code' => 401,
            'message' => 'remember error'
        ]);
    }
}

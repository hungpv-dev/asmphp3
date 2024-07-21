<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    function showFormRegister(){
        $title = 'Đăng kí';
        return view('auth.register',compact('title'));
    }

    public function register(Request $request){
        $validator = $this->validateRegister($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else if(!$request->has('checked')){
            toast('Vui lòng đồng ý với điều khoản và dịch vụ!','warning');
            return back()->withErrors($validator)->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($data);
        $token = Str::random('40').time();
        $user->verifyToken()->create([
            'token' => $token,
            'email' => $user->email,
        ]);
        $this->sendMailVerify($token,$user->email);
        Alert::info('Thông báo','Email xác thực đã được gửi về email của bạn');
        return redirect(route('login'));
    }

    public function sendMailVerify($token,$email){
        $url = route('verify',[$token,$email]);
        Mail::to($email)->queue(new VerifyEmail($url));
    }

    public function validateRegister($request){
        $roles = [
            'name' => ['required','min:4','max:40'],
            'email' => ['required','email',
                    Rule::unique('users')->where(function($query){
                       return $query->whereNull('google_id')
                                    ->whereNull('facebook_id')
                                    ->whereNull('twitter_id');
                    })
                ],
            'password' => ['required','min:8','max:20'],
            'password_confirmation' => ['required','same:password'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc nhập',
            'email' => ':attribute không hợp lệ',
            'unique' => 'Email đã tồn tại',
            'min' => ':attribute tối thiểu :min kí tự',
            'max' => ':attribute tối đa :max kí tự',
            'same' => ':attribute không khớp'
        ];
        $attributes = [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu',
        ];

        $validate = Validator::make($request->all(),$roles,$messages,$attributes);

        return $validate;
    }
}

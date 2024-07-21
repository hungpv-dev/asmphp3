<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailReQuest;
use App\Mail\ForgetPaswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ForgetController extends Controller
{
    use SendsPasswordResetEmails;
    public function showFormForget(){
        $title = 'Quên mật khẩu';
        return view('auth.passwords.email',compact('title'));
    }

    public function forget($email,$token){
        $forget = PasswordResetToken::find($email);
        if($forget){
            if($forget->token === $token){
                $time = $forget->updated_at->addHours(24);
                if(now()->lessThan($time)){
                    $title = 'Đặt lại mật khẩu';
                    return view('auth.passwords.reset',compact('title','email'));
                }else{
                    Alert::error('Thông báo','Email này đã hết hạn');
                }
            }else{
                Alert::error('Thông báo','Thông tin xác thực khong chính xác');
            }
        }else{
            Alert::error('Thông báo','Thông tin xác thực khong chính xác');
        }
        return redirect(route('login'));
    }

    public function forgetSendMail(EmailReQuest $request){
        $user = User::where('email',$request->email)->whereNull('google_id')->where('facebook_id')->whereNull('twitter_id')->first();
        if($user){
            $forget = PasswordResetToken::find($request->email);
            $token = Str::random('40').time();
            if($forget){
                $forget->update([
                    'token' => $token,
                ]);
            }else{
                PasswordResetToken::create([
                    'email' => $request->email,
                    'token' => $token,
                ]);
            }
            $this->sendMailForget($request->email,$token);
            Alert::info('Thông báo','Mail đặt lại mật khẩu đã được gửi');
        }else{
            Alert::error('Thông báo',"Tài khoản không tồn tại trong hệ thống của chúng tôi!");
        }
        return back()->withInput();
    }

    public function sendMailForget($email,$token){
        $link = route("forget.verify",[$email,$token]);
        Mail::to($email)->queue(new ForgetPaswordMail($link));
    }

    public function resetPassword(Request $request){
        $validator = $this->validateForm($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $user = User::where('email',$request->email);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        PasswordResetToken::destroy($request->email);
        Alert::success('Thông báo','Cập nhật mật khẩu thành công');
        return redirect(route('login'));
    }

    public function validateForm($request){
        $roles = [
            'email' => ['required','email'],
            'password' => ['required','min:8','max:20'],
            'password_confirmation' => ['required','same:password'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc nhập',
            'email' => ':attribute không hợp lệ',
            'min' => ':attribute tối thiểu :min kí tự',
            'max' => ':attribute tối đa :max kí tự',
            'same' => ':attribute không khớp'
        ];
        $attributes = [
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu',
        ];

        $validate = Validator::make($request->all(),$roles,$messages,$attributes);

        return $validate;
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailReQuest;
use App\Models\EmailVerifyToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class VerifyController extends Controller
{
    public function showFormVerify(){
        return view('auth.verify');
    }

    public function verify($token,$email){
        $verify = EmailVerifyToken::where('email',$email)->where('token', $token)->first();
        if($verify){
            $time = $verify->updated_at;
            $timeCheck = $time->addHours(24);
            if(now()->lessThan($timeCheck)){
                $verify->user()->update([
                    'email_verified_at' => $time
                ]);
                $verify->delete();
                Alert::success('Chúc mừng','Xác thực tài khoản thành công!');
            }else{
                Alert::warning('Thông báo','Email này đã hết hạn!');
            }
        }else{
            Alert::warning('Thông báo','Thông tin xác thực không chính xác!');
        }
        return redirect(route('login'));
    }

    public function verifySendMail(EmailReQuest $request){
        $user = User::where('email',$request->email)
            ->whereNull('google_id')
            ->whereNull('facebook_id')
            ->whereNull('twitter_id')->first();
        if($user){
            $verify = $user->verifyToken;
            if($verify){
                $token = Str::random('40').time();
                $email = $request->email;
                $verify->update([
                    'token' => $token,
                    'email' => $email
                ]);
                (new RegisterController)->sendMailVerify($token,$email);
                Alert::info('Mail xác thực đã được gửi thành công!');
            }else{
                Alert::info('Thông báo',"Tài khoản này đã được xác thực!");
            }
        }else{
            Alert::error('Thông báo',"Tài khoản không tồn tại trong hệ thống của chúng tôi!");
        }
        return back()->withInput();
    }
}

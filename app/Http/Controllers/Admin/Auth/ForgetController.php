<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailReQuest;
use App\Mail\ForgetPaswordMail;
use App\Models\Admin;
use App\Models\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ForgetController extends Controller
{
    public function showFormSendMail(){
        $title = 'Quên mật khẩu';
        return view('admin.auth.passwords.email',compact('title'));
    }

    public function forget(EmailReQuest $request){
        $email = $request->input('email');
        $token = time().Str::random(40);
        $link = route('admin.verify',[$email,$token]);

        $admin = Admin::where('email',$email)->first();

        if($admin){
            $mail = AdminResetPassword::find($email);
            if($mail){
                $mail->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            }else{
                AdminResetPassword::create([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            }
            $this->sendMail($email,$link);
            Alert::success('Thông báo','Mail đặt lại mật khẩu đã được gửi thành công!');
        }else{
            Alert::warning('Warning','Tài khoản này không tồn tại trong hệ thống!');
        }
        return redirect(route('admin.forget'));
    }
    
    public function sendMail($email,$link){
        Mail::to($email)->queue(new ForgetPaswordMail($link));
    }
}

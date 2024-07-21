<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use App\Models\Admin;
use App\Models\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class VerifyController extends Controller
{
    public function verify($email,$token){
        $reset = AdminResetPassword::find($email);
        if($reset){
            $time = Carbon::now()->diff($reset->created_at);
            if($time->d >= 1){
                Alert::warning('Thông báo','Email này đã hết hạn');
            }else{
                if($token === $reset->token){
                    return view('admin.auth.passwords.reset',compact('email','token'));
                }else{
                    Alert::warning('Thông báo','Thông tin xác thực không chính xác!');
                }
            }
        }
        return redirect(route('admin.login'));
    }

    public function reset(Request $request){
        $reset = AdminResetPassword::find($request->email);
        if($reset && ($reset->token === $request->check_token)){
            $admin = Admin::where('email',$request->email)->first();
            if($admin){
                $admin->update([
                    'password' => Hash::make($request->pass)
                ]);
                $reset->delete();
                Alert::success('Cập nhật thông tin thành công');
            }else{
                Alert::error('Tài khoản không tồn tại!');
            }
        }else{
            Alert::error('Đã có lỗi xảy ra vui lòng thử lại');
        }
        return redirect(route('admin.login'));
    }

}

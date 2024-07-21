<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\{
    Admin,
    Profile
};
use App\Mail\NotifyMail;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(){
        $title = 'Trang cá nhân';
        $user = Admin::find(Auth::guard('admin')->user()->id);
        $profile = $user->profile;
        if(!$profile){
            $profile = new class{
                public $first_name = '';
                public $last_name = '';
                public $tel = '';
                public $address = '';
                public $xa = 0;
                public $huyen = 0;
                public $tinh = 0;
            };
        }
        return view('admin.account.profile',compact('title','profile','user'));
    }

    public function profile(ProfileRequest $request){

        $user = Admin::find(Auth::guard('admin')->user()->id);

        if($request->hasFile('image')){
            $file = $request->file('image');

            $upload = Cloudinary::upload($file->getRealPath(),[
                'folder' => 'avatar-user'
            ]);

            $url = $upload->getSecurePath();
            $public_id = $upload->getFileName();

            $image = $user->image;
            if($image){
                Cloudinary::destroy($image->public_id);
                $image->update([
                    'url' => $url,
                    'public_id' => $public_id
                ]);
            }else{
                $user->image()->create([
                    'url' => $url,
                    'public_id' => $public_id
                ]);
            }

        }


        $profileData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "tel" => $request->tel,
            "address" => $request->address,
            "xa" => $request->ward,
            "huyen" => $request->district,
            "tinh" => $request->province,
        ];

        $profile = $user->profile;

        if($profile){
            $profile->update($profileData);
        }else{
            $user->profile()->create($profileData);
        }
        Alert::success('Thông báo','Cập nhật thông tin thành công');
        return back();
    }

    public function changePassword(Request $request){
        $this->validateChangePass($request);
        $email = $request->email;
        $password = $request->input('old-password');
        $newPassword = $request->input('new-password');
        $admin = Admin::where('email',$email)->first();
        if($admin && Hash::check($password, $admin->password)){
            $admin->update([
                'password' => Hash::make($newPassword)
            ]);
            Alert::success('Thông báo','Mật khẩu đã được đổi thành công');
            $this->sendMailChangePassword($email);
        }else{
            $request->flash();
            Alert::error('Xin lỗi','Thông tin tài khoản không chính xác');
        }
        return back();
    }

    private function validateChangePass($request){
        $rules = [
            'email' => ['required','email'],
            'old-password' => ['required','min:8','max:20'],
            'new-password' => ['required','min:8','max:20'],
            'new-rePassword' => ['required','min:8','same:new-password'],
        ];
        $messages = [
            'required' => ':attribute không được để trống',
            'email' => 'Email không hợp lệ',
            'min' => ':attribute tối thiểu :min kí tự',
            'max' => ':attribute tối đa :max kí tự',
            'same' => 'Mật khẩu không khớp',
        ];
        $attributes = [
            'email' => 'Email',
            'old-password' => 'Mật khẩu',
            'new-password' => 'Mật khẩu',
            'new-rePassword' => 'Mật khẩu',
        ];
        $request->validate($rules,$messages,$attributes);
    }
    public function sendMailChangePassword($email){
        $title = 'Cảnh báo tài khoản';
        $body = 'Tài khoản của bạn đã bị đổi mật khẩu, nếu không phải bạn vui lòng liên hệ chúng tôi để được hỗ trợ!';
        $url = 'facebook.com';
        $btn = 'Nhận hỗ trợ tại đây';
        Mail::to($email)->queue(new NotifyMail($title,$body,$url,$btn));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function index(Request $request){
        $title = 'Tài khoản';
        $orders = Auth::user()->orders()->orderBy('created_at','desc')->get();
        return view('account.index',compact('title','orders'));
    }

    public function address(){
        $title = 'Địa chỉ';
        $user = User::find(auth()->id());
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
        return view('account.address',compact('title','profile','user'));
    }

    public function updateAddress(ProfileRequest $request){
        $user = User::find(auth()->id());

        if($request->hasFile('image')){
            $file = $request->file('image');

            $upload = Cloudinary::upload($file->getRealPath(),[
                'folder' => 'avatar-user'
            ]);

            $url = $upload->getSecurePath();
            $public_id = $upload->getFileName();

            $image = $user->image;
            if($image){
                if(!empty($image->public_id)){
                    Cloudinary::destroy($image->public_id);
                }
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
        toast('Cập nhật thông tin thành công','success');
        return back();
    }
}

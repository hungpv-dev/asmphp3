<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Mail\NotifyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectTo(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request){
        try{
            $user = Socialite::driver('google')->user();

            $findUser = User::where('google_id',$user->id)->first();
            if($findUser){
                Auth::login($findUser);
            }else{
                $account = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random('40')),
                    'status' => 0,
                    'google_id' => $user->id,
                ]);
                $account->image()->create([
                   'url' => $user->avatar,
                   'public_id' => ''
                ]);
                Auth::login($account);
            }
            $request->session()->put('remember_token', true);
            return redirect()->intended('/');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}

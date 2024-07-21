<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirectTo(){
        return Socialite::driver('twitter')->redirect();
    }

    public function callback(Request $request){
        try{
            $user = Socialite::driver('twitter')->user();
            $findUser = User::where('twitter_id',$user->id)->first();
            if($findUser){
                Auth::login($findUser);
            }else{
                $account = User::create([
                    'name' => $user->name,
                    'email' => $user->email ?? 'email@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random('40')),
                    'status' => 0,
                    'twitter_id' => $user->id,
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

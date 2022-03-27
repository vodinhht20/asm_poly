<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function loginScreen(){
        Session::put('url_now',url()->previous());
        return view('auth.loginForm');
    }

    public function redirectGGAuth(){
        return Socialite::driver('google')->redirect();
    }

    public function ggAuthCallback(){
        $ggUser = Socialite::driver('google')->user();
        $user = User::where('email', $ggUser->email)->first();
        if($user){
            $user->avatar = $ggUser->avatar;
            $user->name = $ggUser->name;
            $user->save();
            Auth::login($user);

            if (Session::get('url_now')) { // kiểm tra xem có tồn tại url cũ không
                $url_before = Session::get('url_now'); //lấy ra url trước khi người dùng login
                Session::forget('url_now');
                return redirect($url_before);
            } else {
                return redirect(route('home'));
            }
        }
        return redirect(route('login'));
    }


    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
}

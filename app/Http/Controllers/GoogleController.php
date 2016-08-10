<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Socialite;
use Illuminate\Routing\Controller;

class GoogleController extends Controller
{   
    /**
     * 重導使用者到 Google 認證頁。
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 從 Google 得到使用者資訊
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        if($user = Socialite::driver('google')->user()){
            if($find_user = User::select()->where('email','=',$user->email)->first()){
                Auth::login($find_user);
            }else {
                $add_user = User::create([
                    'email' => $user->email,
                    'name' => $user->name
                ]);
                Auth::login($add_user);
            }
        }
        return redirect()->route('home',['userinfo' => $user]);
        // $user->token;
    }
}
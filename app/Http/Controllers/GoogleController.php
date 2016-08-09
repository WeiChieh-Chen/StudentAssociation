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
        $user = Socialite::driver('google')->user();

        Auth::loginUsingId($user->getId());
        return redirect()->route('home');
        // $user->token;
    }
}
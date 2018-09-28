<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\LaravelSocialite\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        return Socialite::driver('github')->user();
    }

    public function api(Request $request)
    {
        return \App\Tools\Socialite\SocialiteTool::driver('qq')::getSocialiteOrigin($request->input('openid'),
            $request->input('access_token'));
    }
}

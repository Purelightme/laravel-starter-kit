<?php

namespace App\Http\Controllers\Demo;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    public function index()
    {
        return view('vue.passport');
    }

    public function callback(Request $request)
    {
        if (!$request->code){
            return 'token exists in url';
        }

        $http = new Client();

        $response = $http->post('http://starter.test/oauth/token',[
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 1,
                'client_secret' => '4JytVNvnlb2tcRzpVg5Z2M0YFKLHHx0hq3yDDLLT',
                'redirect_uri' => 'http://starter.test/demo/passport/callback',
                'code' => $request->code,
                'scope' => 'userinfo'
            ],
        ]);

//        dd($response->getBody());
        return json_decode((string) $response->getBody(),true);
    }


}

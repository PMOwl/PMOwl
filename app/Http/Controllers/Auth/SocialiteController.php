<?php

namespace App\Http\Controllers\Auth;

use App\Services\SocialiteServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function auth(Request $request)
    {
        $driver = $request->get('driver');
        $oAuthService = app(SocialiteServices::class);

        if($driver == SocialiteServices::DRIVER_GITHUB){
            $response = $oAuthService->githubAuth();
        }else{
            $response = $oAuthService->wechatOpenAuth();
        }

        return $response->send();
    }

    public function callBack(Request $request)
    {

    }
}

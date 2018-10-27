<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/10
 * Time: 18:43
 */

namespace App\Http\Controllers;


use App\Services\SocialiteServices;

class TestController extends Controller
{
    public function test()
    {
        $socialiteService = app(SocialiteServices::class);

        $socialiteService->getByDriver('github', 1);
    }

}
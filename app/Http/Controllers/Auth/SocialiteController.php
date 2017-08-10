<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Repositories\UserRepository;
use App\Services\SocialiteServices;
use Auth;
use Illuminate\Http\Request;
use Session;

class SocialiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Shows a user what their new account will look like.
     */
    public function createSocialiteView()
    {
        if (! Session::has('socialiteData')) {
            return redirect()->route('login');
        }

        $socialiteUser = Session::get('socialiteData');

        return view('auth.sign-up-confirm', compact('socialiteUser'));
    }

    /**
     * Actually creates the new user account
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNewUser(StoreUserRequest $request)
    {
        if (! Session::has('socialiteData')) {
            return redirect()->route('login');
        }

        $socialiteUser = array_merge(Session::get('socialiteData'), $request->only('name', 'email', 'password'));

        $userData = array_only($socialiteUser, array_keys($request->rules()));
        $userData['register_source'] = $socialiteUser['driver'];

        $result = app(SocialiteServices::class)->createUser($userData);
        if($result){
            Auth::login(app(UserRepository::class)->find($result));
            return redirect()->route('home');
        }
        return back();
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function auth(Request $request)
    {
        $driver = $request->get('driver');
        $socialiteService = app(SocialiteServices::class);

        if ($driver == SocialiteServices::DRIVER_GITHUB) {
            $response = $socialiteService->githubAuth();
        } else {
            $response = $socialiteService->wechatOpenAuth();
        }

        return $response->send();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callBack(Request $request)
    {
        $driver = $request->get('driver');

        if (!in_array($driver, SocialiteServices::allowDriver()) || (Auth::check() && Auth::user()->register_source == $driver)) {
            return redirect()->intended('/');
        }

        $socialiteService = app(SocialiteServices::class);

        if ($driver == SocialiteServices::DRIVER_GITHUB) {
            $socialiteUser = $socialiteService->githubCallback();
        } else {
            $socialiteUser = $socialiteService->wechatOpenCallback();
        }
        info('callback info', $socialiteUser);

        $user = $socialiteService->getByDriver($driver, $socialiteUser->id);

        // 绑定第三方账号
        if (Auth::check()) {
            if ($user && $user->id != Auth::id()) {
                flash()->error(trans('Sorry, this socialite account has been registed.', ['driver' => trans($driver)]));
            } else {
                $socialiteService->bindSocialiteUser($socialiteUser, $driver);
                flash()->success(trans('Bind Successfully!', ['driver' => trans($driver)]));
            }
            return redirect()->route('user.edit_social_binding', Auth::id());
        } else {
            // 新注册账号
            // TODO 封禁用户
//            if ($user && $user->is_banned == 'yes') {
//                return redirect()->route('user-banned');
//            }

            $socialiteService->userNotFound($driver, $socialiteUser);
            return redirect()->route('socialite.signUpView');
        }
    }
}

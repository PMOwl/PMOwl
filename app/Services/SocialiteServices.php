<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/9
 * Time: 10:57
 */

namespace App\Services;


use App\Repositories\UserRepository;
use Auth;
use Overtrue\Socialite\ProviderInterface;
use Overtrue\Socialite\SocialiteManager;
use Session;

class SocialiteServices
{
    const DRIVER_GITHUB = 'github';
    const DRIVER_WECHAT_OPEN = 'wechat_open';

    /**
     * @return array
     */
    public static function allowDriver()
    {
        return [
            self::DRIVER_GITHUB,
            self::DRIVER_WECHAT_OPEN,
        ];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function wechatOpenAuth()
    {
        $config = ['wechat_open' => config('services.wechat_open')];

        $socialite = new SocialiteManager($config);

        $driver = $socialite->driver('wechat_open');

        Session::put('socialiteDriver', self::DRIVER_WECHAT_OPEN);

        return $this->auth($driver);
    }

    /**
     * @return \Overtrue\Socialite\User
     */
    public function wechatOpenCallback()
    {
        $config = ['wechat_open' => config('services.wechat_open')];

        $socialite = new SocialiteManager($config);

        $driver = $socialite->driver('wechat_open');

        return $this->callback($driver);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function githubAuth()
    {
        $config = ['github' => config('services.github')];

        $socialite = new SocialiteManager($config);

        $driver = $socialite->driver('github');

        Session::put('socialiteDriver', self::DRIVER_GITHUB);

        return $this->auth($driver);
    }

    /**
     * @return \Overtrue\Socialite\User
     */
    public function githubCallback()
    {
        $config = ['github' => config('services.github')];

        $socialite = new SocialiteManager($config);

        $driver = $socialite->driver('github');

        return $this->callback($driver);
    }

    /**
     * @param $oauthUser
     * @param $driver
     */
    public function bindSocialiteUser($oauthUser, $driver)
    {
        $currentUser = Auth::user();

        if ($driver == self::DRIVER_GITHUB) {
            $currentUser->github_id = $oauthUser->id;
            $currentUser->github_url = $oauthUser->user['url'];
        } elseif ($driver == self::DRIVER_WECHAT_OPEN) {
            $currentUser->wechat_openid = $oauthUser->id;
            $currentUser->wechat_unionid = $oauthUser->user['unionid'];
        }

        $currentUser->save();
    }

    /**
     * @param $driver
     * @param $registerUserData
     */
    public function userNotFound($driver, $registerUserData)
    {
        $socialiteData['driver'] = $driver;

        switch ($driver){
            case self::DRIVER_GITHUB:
                $socialiteData['avatar'] = $registerUserData['avatar_url'];
                $socialiteData['github_id'] = $registerUserData['id'];
                $socialiteData['github_url'] = $registerUserData['url'];
                $socialiteData['name'] = $registerUserData['nickname'];
                $socialiteData['name'] = $registerUserData['name'];
                $socialiteData['email'] = $registerUserData['email'];
                break;
            case self::DRIVER_WECHAT_OPEN:
                $socialiteData['avatar'] = $registerUserData['avatar'];
                $socialiteData['wechat_openid'] = $registerUserData['id'];
                $socialiteData['wechat_unionid'] = $registerUserData['unionid'];
                $socialiteData['name'] = $registerUserData['nickname'];
                $socialiteData['email'] = $registerUserData['email'];
                break;
        }

        Session::put('socialiteData', $socialiteData);
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function createUser($userData)
    {
        return app(UserRepository::class)->create($userData);
    }

    /**
     * @param $driver
     * @param $id
     * @return null
     */
    public function getByDriver($driver, $id)
    {
        $functionMap = [
            'github' => 'getByGithubId',
            'wechat_open' => 'getByWechatOpenId'
        ];
        $function = $functionMap[$driver];
        if (!$function) {
            return null;
        }

        return $this->$function($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function getByGithubId($id)
    {
        return app(UserRepository::class)->findBy('github_id', $id)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function getByWechatOpenId($id)
    {
        return app(UserRepository::class)->findBy('wechat_openid', $id)->first();
    }

    /**
     * @param ProviderInterface $driver
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function auth(ProviderInterface $driver)
    {
        $response = $driver->redirect();

        return $response;
    }

    /**
     * @param ProviderInterface $driver
     * @return \Overtrue\Socialite\User
     */
    protected function callback(ProviderInterface $driver)
    {
        $user = $driver->user();

        return $user;
    }

}
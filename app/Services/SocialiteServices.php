<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/9
 * Time: 10:57
 */

namespace App\Services;


use Overtrue\Socialite\ProviderInterface;
use Overtrue\Socialite\SocialiteManager;

class SocialiteServices
{
    const DRIVER_GITHUB = 'github';
    const DRIVER_WECHAT_OPEN = 'wechat_open';

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function wechatOpenAuth()
    {
        $config = ['wechat_open' => config('services.wechat_open')];

        $socialite = new SocialiteManager($config);

        $driver = $socialite->driver('wechat_open');

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
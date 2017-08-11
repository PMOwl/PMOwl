<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/11
 * Time: 19:17
 */
/**
 * 获取乱序字符串
 * @return array|string
 */
function shuffle_str()
{
    $alphabet = explode(',', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
    shuffle($alphabet);
    $alphabet = implode('', $alphabet);

    return $alphabet;
}
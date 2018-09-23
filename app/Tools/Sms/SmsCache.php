<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/25
 * Time: 15:52
 */

namespace App\Tools\Sms;


use App\Tool\Smss\SmsRedisCache;

abstract class SmsCache
{
    abstract public function rememberCode($scene,$phone,$code,$expire);

    abstract public function checkCode($scene,$phone,$code);

    abstract public function canSendVerifyCode($scene,$phone);

    abstract public function removeCode($scene,$phone);

    public static function driver($name = 'redis')
    {
        switch ($name){
            case 'redis':
                return new SmsRedisCache();
            case 'db':
                return new SmsDbCache();
                break;
        }
    }
}
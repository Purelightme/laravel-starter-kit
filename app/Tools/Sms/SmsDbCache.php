<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/25
 * Time: 20:39
 */

namespace App\Tools\Sms;


use Carbon\Carbon;

class SmsDbCache extends SmsCache
{

    public function rememberCode($scene, $phone, $code, $expire)
    {
        \App\Models\SmsCache::create([
            'scene' => $scene,
            'phone' => $phone,
            'code' => $code,
            'expires_at' => Carbon::now()->addSeconds($expire)
        ]);
    }

    public function checkCode($scene, $phone, $code)
    {
        $cache = \App\Models\SmsCache::getRecordBySceneAndPhone($scene,$phone);
        return $code == $cache->code;
    }

    public function canSendVerifyCode($scene, $phone)
    {
        $record = \App\Models\SmsCache::getRecordBySceneAndPhone($scene,$phone);
        if (!$record)
            return true;
        $now = Carbon::now();
        $expiresAt = Carbon::createFromTimeString($record->expires_at);
        if ($expiresAt->subSeconds(60)->gt($now))
            return true;
        return false;
    }

    public function removeCode($scene, $phone)
    {
        $record = \App\Models\SmsCache::getRecordBySceneAndPhone($scene,$phone);
        $record->delete();
    }
}
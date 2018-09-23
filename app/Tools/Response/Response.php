<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/25
 * Time: 17:22
 */

namespace App\Tools\Response;


use Illuminate\Contracts\Validation\Validator;

class Response
{
    public static function buildSuccess($data = [])
    {
        return [
            'errcode' => 0,
            'errmsg'  => 'ok',
            'data'    => $data
        ];
    }

    public static function buildFail($errcode,$errmsg = '')
    {
        return [
            'errcode' => $errcode,
            'errmsg'  => $errmsg
        ];
    }

    public static function buildVerifyFail(Validator $validator)
    {
        return [
            'errcode' => 2000,
            'errmsg'  => $validator->errors()->first()
        ];
    }
}
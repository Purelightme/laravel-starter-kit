<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/28
 * Time: 14:30
 */

namespace App\Exceptions;


class CommonException extends \Exception
{
    public function render()
    {
        return [
            'errcode' => $this->code,
            'errmsg'  => $this->message
        ];
    }
}
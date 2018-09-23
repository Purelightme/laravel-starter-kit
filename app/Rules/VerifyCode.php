<?php

namespace App\Rules;

use App\Tools\Sms\SmsCache;
use Illuminate\Contracts\Validation\Rule;

class VerifyCode implements Rule
{

    private $scene; //场景

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($scene)
    {
        $this->scene = $scene;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $request = \request();
        $isValid = SmsCache::driver(config('sms.cache.driver'))->checkCode($this->scene,$request->input('phone'),$value);
        if ($isValid)
            SmsCache::driver(config('sms.cache.driver'))->removeCode($this->scene,$request->input('phone'));
        return $isValid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '验证码错误';
    }
}

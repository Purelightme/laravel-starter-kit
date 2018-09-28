<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class IdCard implements Rule
{
    private $age; //限制年满岁数

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($age = 0)
    {
        $this->age = $age;
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
        $times = preg_match('/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)/', $value);
        if (!$times)
            return false;
        if (Carbon::now()->subYears($this->age)->lt(Carbon::createFromDate(substr($value, 6, 4), substr($value, 10, 2),
            substr($value, 12, 2)))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->age > 0)
            return '请提供年满'.$this->age.'岁的合法身份证号';
        return '请提供合法的身份证号';
    }
}

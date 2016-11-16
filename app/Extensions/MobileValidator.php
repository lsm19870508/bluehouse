<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 16:15
 */
namespace App\Extensions;

class MobileValidator
{
    /**
     * 验证是否为一个有效的手机号码
     *
     * @param $attribute
     * @param $value
     * @param parameters
     * @return bool
     */
    public function validateRightMobile($attribute,$value,$parameters)
    {
        if (!is_numeric($value)){
            return false;
        }

        $rules = '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#';

        return preg_match($rules,$value);
    }
}
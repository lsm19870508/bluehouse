<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 16:37
 */
namespace App\Util;

use Illuminate\Support\Facades\Session;

class CoolDown
{
    const CD_KEY = "request_time";
    
    /**
     * 获取两次请求的时间差（秒）
     * 
     * @return float | int
     */
    public static function getRemainingSeconds()
    {
        //否则返回剩余的时间
        $dif = CoolDown::getTimeDif();
        
        //如果是debug，则直接返回0
        if (AppUtil::isLocal()) {
            return 0;
        }

        return (60 - $dif);
    }

    /**
     * 验证码是否有效
     *
     * @return bool
     */
    public static function isCodeStillValid()
    {
        $dif = CoolDown::getTimeDif();
        //有效时常默认为5分钟
        $validPeriod = env("VALIDITY_PERIOD_OF_VERIFCATION_CODE",5) * 60;

        //时间差超过300秒的，无效
        return $dif < $validPeriod;
    }

    /**
     * 设置本次请求的时间
     */
    public static function setThisRequestTime()
    {
        $curTime = time();

        //前台的一分钟倒计时
        Session::put(CoolDown::CD_KEY,$curTime);
    }

    /**
     * 返回获取验证码的时间
     */
    private static function getGetCodeTime()
    {
        return Session::get(CoolDown::CD_KEY);
    }

    /**
     * 返回获取验证码距离现在的时间
     *
     * @return mixed
     */
    private static function getTimeDif()
    {
        $codeTime = CoolDown::getGetCodeTime();
        if (empty($codeTime)) {
            $codeTime = 0;
        }

        return time() - $codeTime;
    }
}
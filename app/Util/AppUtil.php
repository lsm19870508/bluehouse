<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 16:41
 */

namespace  App\Util;

class AppUtil
{
    /**
     * 是否为本地模式
     *
     * @return bool
     */
    public static function isLocal()
    {
        return env('APP_ENV') == 'local';
    }
}
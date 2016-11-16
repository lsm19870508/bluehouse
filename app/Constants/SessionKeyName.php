<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/7
 * Time: 14:57
 */

namespace App\Constants;

class  SessionKeyName
{
    /**
     * 微信网页授权后的token
     */
    const WEB_AUTH_ACCESS_TOKEN = "web_auth_access_token";

    /**
     * 微信用户的openId
     */
    const WX_OPEN_ID = "wx_open_id";

    /**
     * 验证码
     */
    const VALIDATION_CODE = "validation_code";

    /**
     * 验证码获取的时间，5分钟后失效
     */
    const VALIDATION_CODE_EXPIRE_AFTER_5_MINS = "validation_code_expire_after_5_minutes";

    /**
     * 客户端ip
     */
    const CLIENT_IP = "client_ip";
}
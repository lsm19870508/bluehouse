<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/8
 * Time: 16:23
 */

namespace  App\Constants;

class  CacheKeyName
{
    /**
     * 微信相关数据前缀
     */
    const KEY_WEIXIN = "weixin:";
    /**
     * 微信访问令牌key
     */
    const KEY_WEIXIN_ACCESS_TOKEN = "access_token";
    /**
     * 用户的微信公开号码
     */
    const KEY_WEIXIN_OPEN_ID = "open_id";
    /**
     * 微信jsApi签名生成的秘钥
     */
    const KEY_JSAPI_TICKET = "js_api_ticket";
}
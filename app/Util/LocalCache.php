<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/7
 * Time: 17:54
 */
namespace App\Util;

use App\Constants\CacheKeyName;
use Illuminate\Support\Facades\Redis;

class LocalCache
{
    /**
     * @var string 数据库前缀
     */
    private $database_prefix;

    //单例对象
    private static $instance;

    /**
     * 私有构造方法
     *
     * LocalCache constructor.
     */
    private function __construct()
    {

    }

    /**
     * 初始化一些配置信息
     */
    private function initConfig()
    {
        $this->database_prefix = env('REDIS_PREFIX');
    }

    /**
     * 获取单例对象
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(self::$instance) || !(isset(self::$instance))) {
            self::$instance = new self();
            self::$instance->initConfig();
        }

        return self::$instance;
    }

    /**
     * 是否缓存了全局的access_token
     */
    public function hasWXAccessToken()
    {
        return Redis::exists($this->getAccessTokenKey());
    }

    /**
     * 创建微信全局accessToekn键名
     *
     * @return string
     */
    private function getAccessTokenKey()
    {
        return $this->database_prefix . ":" . CacheKeyName::KEY_WEIXIN . CacheKeyName::KEY_WEIXIN_ACCESS_TOKEN;
    }

    /**
     *  获取jsApi的键
     *
     * @return string
     */
    private function getJsApiKey()
    {
        return $this->database_prefix . ":" . CacheKeyName::KEY_WEIXIN . CacheKeyName::KEY_JSAPI_TICKET;
    }

    /**
     * 获取用户的微信accessToken保存到本地（这个要全局唯一)
     *
     * @param $accessToken
     * @param $expiresIn
     *
     */
    public function cacheWXAccessToken($accessToken,$expiresIn)
    {
        $accessTokenKey = $this->getAccessTokenKey();

        //设置2个小时的过期时间
        Redis::setex($accessTokenKey, $expiresIn, $accessToken);
    }

    /**
     * 获取微信的JsApi签名生成需要使用的秘钥
     *
     * @return bool | null | string
     */
    public function getWXJsApiTicket()
    {
        $key = $this->getJsApiKey();

        if (Redis::exists($key)) {
            return Redis::get($key);
        }

        return null;
    }

    /**
     * 缓存微信的JsApi签名生成需要使用的秘钥
     *
     * @param $ticket
     */
    public function cacheWXJsApiTicket($ticket)
    {
        //设置秘钥过期时间为7150秒
        Redis::setex($this->getJsApiKey(), 7150, $ticket);
    }

    /**
     * 获取微信AccessToken
     *
     * @return null|string
     */
    public function getWXAccessToken()
    {
        $accessTokenKey = $this->getAccessTokenKey();

        if ($this->hasWXAccessToken()) {
            return Redis::get($accessTokenKey);
        } else {
            return null;
        }
    }
}
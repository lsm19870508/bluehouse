<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/7
 * Time: 17:30
 */

namespace App\Traits;

use App\Util\LocalCache;
use GuzzleHttp\Client;
use Monolog\Logger;

trait WeiXinHelper
{
    /**
     * 检查是否意境获取了通用接口的access_token(注意和网页授权的access_token的区别)
     */
    public function checkAccessToken()
    {
        //如果没有缓存access_token
        if (!LocalCache::getInstance()->hasWXAccessToken()) {
            $client = new Client();

            $appId = env("WEIXIN_APP_ID");
            $appSecret = env("WEIXIN_APP_SECRET");
            $accessTokenApi = vsprintf(env("WEIXIN_ACCESS_TOKEN_URL"),[$appId,$appSecret]);

            $response = $client->get($accessTokenApi);
            //将结果转为JSON格式，后面为true,转换为对应数组
            $arrData = \GuzzleHttp\json_decode((string)$response->getBody(),true);
            //有报错
            if (array_key_exists("errcode",$arrData)) {
                
            } else {
                LocalCache::getInstance()->cacheWXAccessToken($arrData['access_token'],$arrData['expires_in']);
            }
        }
    }

    /**
     * 获取调用微信jsApi的签名
     *
     * @return array
     */
    public function generateJSApiSignature()
    {
        $ticket = $this->acquireJSApiTicket();
        $result = [
            'timestamp' => 0,
            'noncestr' => 'qm',
            'signature' => 'qm',
            'appId' => 'am',
        ];
    }

    /**
     * 获取生成微信jsApi签名的钥匙
     *
     * @return string | null
     */
    public function acquireJSApiTicket()
    {
        //先从缓存中取
        $ticket = LocalCache::getInstance()->getWXJsApiTicket();
        
        if (is_null($ticket) || $ticket == ''){
            $client = new Client();
            $apiURL = vsprintf(env("WEIXIN_JSAPI_TICKET_URL"), LocalCache::getInstance()->getWXAccessToken());
            $response = $client->get($apiURL);

            //将结果转换为JSON格式，后面为true,转换为对应的数组
            $arrData = \GuzzleHttp\json_decode((string)$response->getBody(),true);
            //获取成功
            if (((int)$arrData['errcode']) == 0) {
                //缓存
                LocalCache::getInstance()->cacheWXJsApiTicket($arrData['ticket']);
                return $arrData['ticket'];
            } else {
                return null;
            }
        } else {
            return $ticket;
        }
    }

    /**
     * 发送模板消息给制定用户
     *
     * @param $toUserOpenId
     * @param $templateId
     * @param $data
     */
    public function sendTemplateMessage($toUserOpenId, $templateId,$data)
    {
        $client = new Client();

        $apiURL = vsprintf(env("WEIXIN_TEMPLATE_MESSAGE_URL"), LocalCache::getInstance()->getWXAccessToken());

        $response = $client->post($apiURL, [
            'json' => [
                'touser' => $toUserOpenId,
                'template_id' => $templateId,
                'data' => $data
            ]
        ]);
        
        //将结果转为JSON格式，后面为true,转换为对应的数组
        $arrData = \GuzzleHttp\json_decode((string)$response->getBody(), true);
        //发送成功(以下都不做处理了）
        if (((int)$arrData['errcode'])==0) {
            
        } else {
            Logger::saveLog(9999, '[errcode=>' . $arrData['errcode'] . ' | msg=>' . $arrData['errmsg'] .
                ' | msgid=>' . (array_key_exists('msgid', $arrData) ? $arrData['msgid'] : "not sent") . ']');
        }
    }
}
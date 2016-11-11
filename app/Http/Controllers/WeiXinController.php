<?php

namespace App\Http\Controllers;

use App\Constants\SessionKeyName;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Traits\WeiXinHelper;
use Illuminate\Support\Facades\Input;

class WeiXinController extends Controller
{
    //
    /**
     * 微信网页授权2.0(获取code以获取accessToken)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function weixinAuth20()
    {
        $appId = env("WEIXIN_APP_ID");
        // 回调网址
        $redirectURL = urlencode(env('WEIXIN_WEB_AUTH_REDIRECT_URL'));
        $authURL = vsprintf(env("WEIXIN_WEB_PAGE_AUTH20"), [$appId, $redirectURL]);
        // 重定向到微信授权页面
        return response()->redirectTo($authURL);
    }

    /**
     * 获取微信的网页accessToken并前往H5首页
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function webAuthAccessTokenToIndex()
    {
        $code = Input::get("code");

        $appId = env("WEIXIN_APP_ID");
        $appSecret = env("WEIXIN_APP_SECRET");
        $webAuthAccessTokenURL = vsprintf(env("WEIXIN_WEB_AUTH_ACCESS_TOKEN_URL"), [$appId, $appSecret, $code]);
        $guzzleClient = new Client();
        $response = $guzzleClient->request('GET', $webAuthAccessTokenURL);

        // 将结果转为JSON格式,后面为true,转换为对应的数组
        $arrData = \GuzzleHttp\json_decode((string)$response->getBody(), true);
        // 判断是否获取到code
        if (array_key_exists("errcode", $arrData)) {
            return view('errors.401')->withContent(trans('app.401.weixin.accessTokenNotAcquired'));
        } else {
            // 将网页授权的accessToken写入session
            Session::put(SessionKeyName::WEB_AUTH_ACCESS_TOKEN, $arrData["access_token"]);
            // 每个用户保留自己的openId
            Session::put(SessionKeyName::WX_OPEN_ID, $arrData["openid"]);

            return $this->redirectToIndex();
        }
    }

    /**
     * 重定向到首页（这样可以保证浏览器里的url变为自己想要的)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectToIndex()
    {
        return response()->redirectTo(env('WEIXIN_APP_INDEX'));
    }
    
    /**
     * 首页
     * 
     * @return View
     */
    public function index()
    {
        $this->checkAccessToken();

        $result = $this->generateJSApiSignature();

        //加入一个标识，告知前端是否为测试服
        $result['status'] = env('APP_ENV');

        return view("app/index")->withConfig($result);
    }
}

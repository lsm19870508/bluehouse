<?php

namespace App\Http\Middleware;

use App\Constants\SessionKeyName;
use Closure;

class WeiXinAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env("APP_ENV","Production") == 'Production') {
            $accessToken = Session::get(SessionKeyName::WEB_AUTH_ACCESS_TOKEN);

            //如果没有微信的accessToken,则返回未授权
            if (is_null($accessToken) || $accessToken == '') {
                return response(trans('app.401.weixin.accessTokenNotAcquired'),401);
            }
        }

        return $next($request);
    }
}

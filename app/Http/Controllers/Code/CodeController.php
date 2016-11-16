<?php

namespace App\Http\Controllers\Code;

use App\Constants\SessionKeyName;
use App\Jobs\HuaXingSNSJob;
use App\Util\CoolDown;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CodeController extends Controller
{
    //
    /**
     * 验证码获取间隔时间尚未冷却结束
     */
    const CD_NOT_OVER = 9001;

    /**
     * 获取验证码
     *
     * @param $request
     * @return mixed
     */
    public function getValidationCode(Request $request)
    {
        //先看看是否超过冷却期
        $timeDif = CoolDown::getRemainingSeconds();

        if ($timeDif<=0) {
            $this->validate($request, ['phone' => 'required | digits:11 | right_mobile']);
            //生成一个随机4位的字符串
            $code = Math::next();
            $phone = Input::post("phone");
            $result = null;
            //这里分环境决定是否真发送短信
            if (!parent::isLocal()) {
                $result = $this->dispatch(new HuaXingSNSJob($phone,trans('matchStatistic.reg.validation_code_tip', ['code' => $code])));
            } else {
                $result = ["code" => 0];
            }
            //发送code后保存到session里
            if (intval($result["code"]) == parent::getOkCode()) {
                //写入Session
                Session::put(SessionKeyName::VALIDATION_CODE,$code);
                //开始计时
                CoolDown::setThisRequestTime();

                return parent::json([
                    'code' => parent::getOkCode(),
                    'yourCode' => Session::get(SessionKeyName::VALIDATION_CODE),
                ]);
            } else {
                return parent::json($result);                
            }

        } else {
            return parent::json([
                'code' => CodeController::CD_NOT_OVER,
                'leftSec' => $timeDif,
                'msg' => trans('matchStatistic.reg.cd_not_over',['leftSec' => $timeDif]),
            ]);
        }
    }
}

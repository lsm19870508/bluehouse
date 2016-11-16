<?php

namespace App\Http\Controllers;

use App\Http\Response\CommonResponseCode;
use App\Traits\WeiXinHelper;
use App\Util\AppUtil;
use App\Util\Logger;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use AuthorizesResources,WeiXinHelper;

    /**
     * 记录日志
     *
     * @param $who
     * @param $what
     */
    protected function saveLog($who,$what)
    {
        Logger::saveLog($who,$what);
    }

    /**
     * 是否为本地开发
     *
     * @return bool
     */
    protected function isLocal()
    {
        return AppUtil::isLocal();
    }

    /**
     * 返回简单操作结果
     *
     * @param $oprCode
     * @return mixed
     */
    protected function result($oprCode)
    {
        return $this->json(['code' => $oprCode]);
    }

    /**
     * 操作成功的响应
     *
     * @return mixed
     */
    protected function ok()
    {
        return $this->result(CommonResponseCode::OPR_OK);
    }

    /**
     * 获取操作成功码
     *
     * @return int
     */
    protected function getOkCode()
    {
        return CommonResponseCode::OPR_OK;
    }

    /**
     * 返回json数据
     *
     * @param array $data
     * @return mixed
     */
    protected function json(Array $data)
    {
        return response()->json($data);
    }

    /**
     * 从一个键值对数组中移除某个key
     *
     * @param $data
     * @param $key
     * @return mixed
     */
    protected function array_remove($data,$key) {
        if (!array_key_exists($key,$data)) {
            return $data;
        }

        $keys = array_keys($data);
        $index = array_search($key,$keys);

        if ($index !== FALSE) {
            array_splice($data,$index,1);
        }

        return $data;
    }
}

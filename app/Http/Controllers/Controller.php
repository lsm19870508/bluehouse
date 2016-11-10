<?php

namespace App\Http\Controllers;

use App\Traits\WeiXinHelper;
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
}

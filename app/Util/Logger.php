<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/10
 * Time: 15:33
 */

namespace App\Util;

use App\Model\Log;

class Logger
{
    /**
     * 保存一条记录
     *
     * @param $who
     * @param $what
     */
    static function saveLog($who,$what)
    {
        $log = new Log([
            "who" => $who,
            "what" => $what,
        ]);

        $log->save();
    }
}
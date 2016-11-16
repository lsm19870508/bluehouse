<?php

namespace App\Util;

/**
 * 生成N位的随机数字（包含字母与数字）
 *
 * Class Random
 * @package app\Util
 *
 * Created by PhpStorm.
 * User: SuperMason
 * Date: 2016/4/20
 * Time: 14:16
 */
class Math
{
    /**
     * 根据参数生成指定长度的随机字符串
     *
     * @param int $len
     * @return string
     */
    public static function next($len = 4)
    {
        $chars_array = [
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
//            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
//            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
//            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
//            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
//            "S", "T", "U", "V", "W", "X", "Y", "Z",
        ];
        $charsLen = count($chars_array) - 1;

        $result = "";
        for ($i = 0; $i < $len; $i++) {
            $result .= $chars_array[mt_rand(0, $charsLen)];
        }

        return $result;
    }

    /**
     * 计算两个数字的百分比
     *
     * @param $numOne
     * @param $numTwo
     * @return float|int
     */
    public static function calculatePercentage($numOne, $numTwo)
    {
        if ($numTwo == 0) {
            return 0;
        }

        return sprintf("%.0f", $numOne / $numTwo * 100);
    }
}
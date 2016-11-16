<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 10:56
 */
namespace App\Http\Response;

class CommonResponseCode
{
    /**
     * 表示一次操作成功的状态码
     */
    const OPR_OK = 0;

    /**
     * 登录信息丢失
     */
    const AUTH_FAILURE = 9998;

    /**
     * 表单验证异常
     */
    const VALIDATION_EXCEPTION_CODE = 9999;
}
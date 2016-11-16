<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| 微信专用路由组
|--------------------------------------------------------------------------
|
|
|
*/
// 网站根 为前往微信网页auth2.0的授权页面
Route::get("/", "WeiXinController@weixinAuth20");

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    // 获取微信accessToken并跳转至H5 首页
    Route::get("/waAccessToken", "WeiXinController@webAuthAccessTokenToIndex");
    //进行中间件验证
    Route::group(['prefix' => 'weixin','middleware' => 'weixin.auth'],function (){
        //app首页
        Route::get("/","WeiXinController@index");
        Route::post("/code","Code/CodeController@");
    });
});

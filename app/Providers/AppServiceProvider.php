<?php

namespace App\Providers;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerValidationRules($this->app['validator']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * 注册自定义验证器
     *
     * @param \Illuminate\Contracts\Validation\Factory $validator
     */
    protected function registerValidationRules(Factory $validator)
    {
        //使用自定义的手机号码验证器
        $validator->extend('right_mobile', 'App\Extensions\MobileValidator@validateRightMobile');
    }
}

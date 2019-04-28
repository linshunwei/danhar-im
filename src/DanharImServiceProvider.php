<?php

namespace Linshunwei\DanharIm;

use Illuminate\Support\ServiceProvider;

class DanharImServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //这里使用到了facades中的字符串
        $this->app->singleton('danharim',function(){
            //我们可以通过facades的aliase访问下面的MoreAction
            //会在config的app.php文件中进行服务提供者和别名的注册
            return $this->app->make('DanharIm');
        });
    }
}

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
	    $this->publishes([
		    __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'danhar-im.php' => config_path('danhar-im.php'),
	    ], 'config');
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
	        return new DanharIm();
        });
    }
}

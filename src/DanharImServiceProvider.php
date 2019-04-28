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

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
	    if ($this->app->runningInConsole()) {
		    $this->publishes([
			    __DIR__ . '/../config/danhar-im.php' => config_path('danhar-im.php'),
		    ]);
	    }
	    $this->mergeConfigFrom(__DIR__.'/../config/xunsearch.php', 'xunsearch');
        //这里使用到了facades中的字符串
        $this->app->singleton('danharim',function(){
	        return new DanharIm();
        });
    }
}
